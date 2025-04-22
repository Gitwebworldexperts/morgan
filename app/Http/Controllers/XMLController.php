<?php
namespace App\Http\Controllers;

use App\Models\RentPropertie;
use App\Models\BuyPropertie;

use App\Models\TempRentPropertie;
use App\Models\TempBuyPropertie;

use App\Models\ListingDetail;
use DB;
use App\Models\PropertyType;
use App\Models\Amenitie;
use App\Models\Banners;
use App\Models\Community;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Jobs\DownloadImageJob;
use Laravel\Socialite\Facades\Socialite;


use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;


class XMLController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
   

    public function startWorker()
    {
        // Using Artisan::call
        Artisan::call('queue:work', [
            '--tries' => 3,
        ]);

        return response()->json([
            'message' => 'Queue worker started successfully!',
            'output' => Artisan::output(),
        ]);
    }

 public function syncRaptor()
{
    ini_set('max_execution_time', 0);
    ini_set('memory_limit', '2G');
    // config(['app.debug' => true]);

    $url = "https://feed.propertyraptor.com/raptorfeed/df/eu20_001/xml/RfDataFeed.xml";
    $response = Http::get($url);

    if ($response->successful()) {
        $listingIds = [];
        $xmlContent = simplexml_load_string($response->body());
        $xmlArray = json_decode(json_encode($xmlContent), true);

        $batchSize = 50;
        $properties = array_chunk($xmlArray['property'], $batchSize);

        foreach ($properties as $batch) {
            foreach ($batch as $item) {
                $listingIds[] = $item['reference_number'];
            }
        }

        // Fetch existing properties
        $rentProperties = RentPropertie::whereNotNull('reference_number')->get();
        $buyProperties = BuyPropertie::whereNotNull('reference_number')->get();

        $rentReferenceNumbers = $rentProperties->pluck('reference_number')->toArray();
        $buyReferenceNumbers = $buyProperties->pluck('reference_number')->toArray();

        $mergedArray = array_merge($rentReferenceNumbers, $buyReferenceNumbers);
        $difference = array_diff($mergedArray, $listingIds); // Properties to be removed

        // Copy missing properties to temp tables
        $missingRentProperties = $rentProperties->whereIn('reference_number', $difference);
        $missingBuyProperties = $buyProperties->whereIn('reference_number', $difference);

        if ($missingRentProperties->isNotEmpty()) {
            foreach ($missingRentProperties as $property) {
                TempRentPropertie::create($property->toArray());
            }
        }

        if ($missingBuyProperties->isNotEmpty()) {
            foreach ($missingBuyProperties as $property) {
                TempBuyPropertie::create($property->toArray());
            }
        }

        // Remove missing properties from the main tables
        RentPropertie::whereIn('reference_number', $difference)->delete();
        BuyPropertie::whereIn('reference_number', $difference)->delete();

        return "Sync Raptor Completed - Copied & Removed Missing Properties";
    } else {
        \Log::error('SYNC Raptor: Failed to retrieve XML data from ' . $url);
        return response()->json(['error' => 'Failed to retrieve XML data SYNC Raptor'], 500);
    }
}


    public function getXml()
{
    ini_set('max_execution_time', 0); // Unlimited execution time
    ini_set('memory_limit', '2G'); // Increase memory limit to 2 GB

    // $url = "https://myprojectdemonstration.net/development/morgan/web/xml/RfDataFeed.xml";
    $url = "https://feed.propertyraptor.com/raptorfeed/df/eu20_001/xml/RfDataFeed.xml";
    
    $response = Http::get($url);

    if ($response->successful()) {
        $xmlContent = simplexml_load_string($response->body());
        $xmlArray = json_decode(json_encode($xmlContent), true);

        $batchSize = 50; // Batch size for chunking data
        $properties = array_chunk($xmlArray['property'], $batchSize);

        $count = $update = 0;

        foreach ($properties as $batch) {
            foreach ($batch as $item) {
                // Process each property item
                $this->processProperty($item, $count, $update);
            }

            // Pause for a short time to avoid overwhelming the server
            usleep(500000); // 0.5 second delay between batches
        }

        return "Newly Inserted properties: " . $count . " and updated properties: " . $update;
    } else {
        \Log::error('Failed to retrieve XML data from ' . $url);
        return response()->json(['error' => 'Failed to retrieve XML data'], 500);
    }
}

public function processProperty($item, &$count, &$update)
{
    // Determine if this is a rental or purchase offering
    if ($item['offering_type'] == "Rental") {
        $existingProperty = RentPropertie::where('reference_number', $item['reference_number'])->first();
        $slug = generateSlug($item['property_name'] ?? 'default_name' . "_rent", \App\Models\RentPropertie::class);
        $property = $existingProperty ?: new RentPropertie();
    } elseif ($item['offering_type'] == "Purchase") {
        $existingProperty = BuyPropertie::where('reference_number', $item['reference_number'])->first();
        $slug = generateSlug($item['property_name'] ?? 'default_name' . "_buy", \App\Models\BuyPropertie::class);
        $property = $existingProperty ?: new BuyPropertie();
    } else {
        return; // Skip non-rental/purchase items
    }

    // If the property exists and is up-to-date, skip it
    if ($existingProperty && isset($item['@attributes']['last_update']) && $item['@attributes']['last_update'] <= $existingProperty->updated_at) {
        $update++;
        return;
    }

    // Handle amenities
    $amenitiesIds = [];
    if(isset($item['private_amenities']) && !empty($item['private_amenities'])){
        $amenitiesIds = $this->handleAmenities($item['private_amenities']);
    }
    

    // Handle location and geopoints
    $iframe = $this->getIframe($item['geopoints']);

    // Set property attributes
    $property->status = "active";
    $property->iframe = $iframe;
    // $property->name = $item['property_name'] ?? 'No name available';
    $property->name = $item['title_en'] ?? 'No name available';
    $property->meta_title = $item['title_en'] ?? '';
    $property->slug = $slug;
    // $property->address = ($item['location_lv5'] ?? '') . ', ' . ($item['location_lv4'] ?? '');
    $property->address = $item['location_lv4'];
    // $property->google_maps_link = $this->getGoogleMapsLink($item);
    $property->google_maps_link = $item['location_lv4'];
    $property->area = $item['size'] ?? 'N/A';
    $property->jacuzzi = $item['bathroom'] ?? 0;
    $property->bed = $item['bedroom'] ?? 0;
    $property->price = $item['price']['yearly'] ?? $item['price'];
    $property->amenities_id = implode(",", $amenitiesIds);
    $property->sale_price = $item['price']['yearly'] ?? $item['price'];
    $property->updated_at = $item['@attributes']['last_update'] ?? now();
    $property->description = $item['description_en'] ?? 'No description available';
    $property->reference_number = $item['reference_number'] ?? '';
    $property->geopoints = $item['geopoints'] ?? '';
    $property->XML = json_encode($item);

    // Handle agent details
    $this->handleAgent($item, $property);

    // Handle property type/category
    $this->handlePropertyType($item, $property);

    // Save the property
    $property->save();
    $count++;

    // Handle images (async or bulk)
    $this->handleImages($item, $property);

    // Save again after handling images
    $property->save();
}

public function handleAmenities($amenitiesStr)
{
    $amenities = explode(",", $amenitiesStr);
    $amenitiesIds = [];

    foreach ($amenities as $amenitie) {
        $amenitieData = Amenitie::firstOrCreate(['amenity_name' => $amenitie], ['status' => '1']);
        $amenitiesIds[] = $amenitieData->id;
    }

    return $amenitiesIds;
}

public function getIframe($geopointsStr)
{
    $geopoints = explode(",", $geopointsStr);
    $longitude = $geopoints[0] ?? null;
    $latitude = $geopoints[1] ?? null;
    return "<iframe width='600' height='450' frameborder='0' style='border:0' src='https://www.google.com/maps?q=$latitude,$longitude&hl=en&z=12&output=embed' allowfullscreen></iframe>";
}

public function getGoogleMapsLink($item)
{
    return implode(', ', [
        $item['location_lv5'] ?? '',
        $item['location_lv4'] ?? '',
        $item['location_lv3'] ?? '',
        $item['location_lv2'] ?? '',
        $item['location_lv1'] ?? ''
    ]);
}

public function handleAgent($item, &$property)
{
    if (isset($item['agent']) && !empty($item['agent'])) {
        if (isset($item['agent']['email']) && !empty($item['agent']['email'])) {
            $agent = Agent::where('email', $item['agent']['email'])->first();

            if (!$agent) {
                $agent = new Agent();
                $agent->detail = $item['agent']['title'];
                $agent->email = $item['agent']['email'];
                $agent->mobile = $item['agent']['phone'];
                $agent->phone = $item['agent']['phone'];
                $agent->name = $item['agent']['name'];

                // Download and store agent photo asynchronously or via job
                $this->handleAgentPhoto($item['agent']['photo']['url'], $agent);
                
                $agent->save();
            }

            $property->agent = $agent->id;
        }
    }
}

public function handleAgentPhoto($photoUrl, $agent)
{
    // Handle agent photo download and saving logic here (consider queueing this task)
    $imageResponse = Http::get($photoUrl);
    $timestamp = now()->timestamp;
    $extension = 'png';
    $newFileName = 'image_' . $timestamp . '.' . $extension;
    $imagePath = 'images/' . $newFileName;
    file_put_contents($imagePath, $imageResponse->body());
    $agent->photo = $imagePath;
}

public function handlePropertyType($item, &$property)
{
    if (isset($item['category'])) {
        $propertyType = PropertyType::firstOrCreate(
            ['type_name' => $item['property_type'], 'property' => $item['offering_type'] == "Rental" ? 'rent' : 'buy'],
            ['status' => '1']
        );
        $property->category_id = $propertyType->id;
    }
}

public function handleImages_old($item, &$property)
{
    $tableName = $property->getTable();
    if (isset($item['photo']) && is_array($item['photo'])) {
        foreach ($item['photo'] as $key => $pic) {
            foreach ($pic as $mkey => $i_pic) {
                // Download and save image asynchronously or in bulk
                
                $this->saveImage($i_pic, $property,($tableName == "rent_properties")? "rent":'buy',$mkey);
            }
        }
    }
}

public function handleImages($item, &$property)
{
    $tableName = $property->getTable();
    if (isset($item['photo']) && is_array($item['photo'])) {
        foreach ($item['photo'] as $key => $pic) {
            foreach ($pic as $mkey => $i_pic) {
                // Dispatch the download image job to the queue
                DownloadImageJob::dispatch($i_pic, $property, ($tableName == "rent_properties") ? "rent" : 'buy', $mkey);
            }
        }
    }
}


public function saveImage($imageUrl, &$property,$property_type,$key)
{
    $imageResponse = Http::get($imageUrl);
    $timestamp = now()->timestamp;
    $extension = 'png';
    $newFileName = 'image_' . $timestamp. $key . '.' . $extension;
    $imagePath = 'images/' . $newFileName;
    file_put_contents($imagePath, $imageResponse->body());

    // Store image in the banners table
    $banner = new Banners();
    $banner->image_url = 'images/' . $newFileName;
    $banner->page_type = $property_type; 

    
    $banner->property_id = $property->id;
    $banner->save();

    // echo "<pre>";var_dump($banner);
    // Set the first image as featured
    if (empty($property->featured_image)) {
        $property->featured_image = 'images/' . $newFileName;
    }
}


private function downloadImage($url)
{
    if ($url) {
        $imageResponse = Http::get($url);
        if ($imageResponse->successful()) {
            $timestamp = now()->timestamp;
            $extension = 'png';
            $newFileName = 'image_' . $timestamp . '.' . $extension;
            $imagePath = 'images/' . $newFileName;
            file_put_contents($imagePath, $imageResponse->body());
            return $imagePath;
        }
    }
    return null;
}


    
}
