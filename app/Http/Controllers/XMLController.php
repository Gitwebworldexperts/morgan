<?php
namespace App\Http\Controllers;

use App\Models\RentPropertie;
use App\Models\BuyPropertie;
use App\Models\ListingDetail;
use DB;
use App\Models\PropertyType;
use App\Models\Amenitie;
use App\Models\Banners;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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
    public function getXml()
    {
        ini_set('max_execution_time', 0); // Increase execution time
        set_time_limit(0);
        $url = "https://myprojectdemonstration.net/development/morgan/web/xml/RfDataFeed.xml";
        $response = Http::get($url);
    
        if ($response->successful()) {
            $xmlContent = simplexml_load_string($response->body());
            $xmlArray = json_decode(json_encode($xmlContent), true);
            $count = $update = 0;
    
            if (isset($xmlArray['property']) && !empty($xmlArray['property']) && count($xmlArray['property'])) {
                foreach ($xmlArray['property'] as $item) {
                    $count++;
                    $buy = BuyPropertie::where('reference_number', $item['reference_number'])->first();
                    if ($buy) {
                        $update++;
                        // Only continue if the property hasn't been updated
                        if (isset($item['@attributes']['last_update']) && $item['@attributes']['last_update'] <= $buy->updated_at) {
                            continue;
                        }
                    }
                    $amenities = explode(",", $item['private_amenities']);
                    $amenities_ids = [];
                    foreach ($amenities as $amenitie) {
                        $amenitie_data = Amenitie::where('amenity_name', $amenitie)->first();
                        if (empty($amenitie_data)) {
                            $amenitie_data = new Amenitie();
                            $amenitie_data->amenity_name = $amenitie;
                            $amenitie_data->status = '1';
                            $amenitie_data->save();
                        }
                        // Collect the ID of the found or newly created amenity
                        $amenities_ids[] = $amenitie_data->id;
                    }
                    
                   
    
                    
    
                    // Extract longitude and latitude
                    $geopoints = isset($item['geopoints']) ? explode(",", $item['geopoints']) : [null, null];
                    $longitude = $geopoints[0] ?? null;
                    $latitude = $geopoints[1] ?? null;
                    $iframeUrl = "https://www.google.com/maps?q=$latitude,$longitude&hl=en&z=12&output=embed";
                    $iframe = "<iframe width='600' height='450' frameborder='0' style='border:0' src='$iframeUrl' allowfullscreen></iframe>";
    
                    // Generate a unique slug for the property
                    $slug = generateSlug($item['property_name'] ?? 'default_name' . "_buy", \App\Models\BuyPropertie::class);
                        echo $slug ."<br>";
                    // Create or update the property instance
                    $property = $buy ?: new BuyPropertie();
    
                    // Set property attributes
                    $property->status = "active";
                    $property->iframe = $iframe;
                    $property->name = $item['property_name'] ?? 'No name available';
                    $property->meta_title = $item['title_en'] ?? '';
                    $property->slug = $slug;
                    $property->address = ($item['location_lv1'] ?? '') . ', ' . ($item['location_lv2'] ?? '');
                    $property->google_maps_link = implode(', ', [
                        $item['location_lv1'] ?? '',
                        $item['location_lv2'] ?? '',
                        $item['location_lv3'] ?? '',
                        $item['location_lv4'] ?? '',
                        $item['location_lv5'] ?? ''
                    ]);
                    $property->area = $item['size'] ?? 'N/A';
                    $property->jacuzzi = $item['bathroom'] ?? 0;
                    $property->bed = $item['bedroom'] ?? 0;
                    $property->price = $item['price']['yearly'] ?? 0;
                    $property->amenities_id = implode(",", $amenities_ids);
                    $property->sale_price = $item['price']['yearly'] ?? 0;
                    $property->updated_at = $item['@attributes']['last_update'] ?? now();
                    $property->description = $item['description_en'] ?? 'No description available';
                    $property->reference_number = $item['reference_number'] ?? '';
                    $property->geopoints = $item['geopoints'] ?? '';
                    $property->XML = json_encode($item);
    
                    if (!$buy) {
                        if(isset($item['agent']) && !empty($item['agent'])){
                            if(isset($item['agent']['email']) && !empty($item['agent']['email'])){
                                $agent = Agent::where('email',$item['agent']['email'])->first();
                                if(!$agent){
                                    $agent = new Agent();
                                    $agent->detail = $item['agent']['title']; 
                                    $agent->email = $item['agent']['email']; 
                                    $agent->mobile = $item['agent']['phone'];
                                    $agent->phone = $item['agent']['phone'];
                                    $agent->name = $item['agent']['name'];
                                    
                                    $imageResponse = Http::get($item['agent']['photo']['url']);
                                    $timestamp = now()->timestamp;
                                    $extension = 'png';
                                    $newFileName = 'image_' . $timestamp . '.' . $extension;
                                    $imagePath = 'images/' . $newFileName;
                                    file_put_contents($imagePath, $imageResponse->body());
                                    $agent->photo = $imagePath;
                                    $agent->save();
                                }
                                $property->agent = $agent->id;
                            }
                        }
                    }
                    if (!$buy) {
                        if($item['category']){
                            $property_type = PropertyType::where(['type_name'=>$item['category'],'property'=>'buy'])->first();
                            if(!$property_type){
                                $property_type = new PropertyType();
                                $property_type->type_name = $item['category']; 
                                $property_type->property = 'buy';
                                $property_type->status = '1';
                                $property_type->save();
                            }
                            $property->category_id = $property_type->id;
                        }
                    }

                    // Save the property
                    $property->save();
                    if (!$buy) {
                        if (isset($item['photo']) && is_array($item['photo'])) {
                            foreach ($item['photo'] as $key => $pic) {
                                if (count($pic)) {
                                    foreach ($pic as $keys => $i_pic) {
                                        $imageResponse = Http::get($i_pic);
                                        $timestamp = now()->timestamp;
                                        $extension = 'png';
                                        $newFileName = 'image_' . $timestamp . '.' . $extension;
                                        $imagePath = 'images/' . $newFileName;
                                        file_put_contents($imagePath, $imageResponse->body());

                                        // Store the image in the banners table
                                        $banner = new Banners();
                                        $banner->image_url = 'images/' . $newFileName;
                                        $banner->page_type = 'buy'; // Set the appropriate page_id if needed
                                        $banner->property_id = $property->id; // Associate with the property
                                        $banner->save();
        
                                        // Set the first image as featured
                                        if ($keys == 1) {
                                            $property->featured_image = 'images/' . $newFileName;
                                        }
                                    }
                                }
                            }
                        }
                    }
    
                    // Save the property again after handling the photos
                    $property->save();
                }
            }
    
            return "Newly Inserted properties: " . $count . " and updated properties: " . $update;
        } else {
            \Log::error('Failed to retrieve XML data from ' . $url);
            return response()->json(['error' => 'Failed to retrieve XML data'], 500);
        }
    }

    public function getXml__old()
{
    ini_set('max_execution_time', 0); // Increase execution time
    set_time_limit(0); // Adjust PHP's time limit

    $url = "https://myprojectdemonstration.net/development/morgan/web/xml/RfDataFeed.xml";
    $response = Http::get($url);

    if ($response->successful()) {
        $xmlContent = simplexml_load_string($response->body());
        $xmlArray = json_decode(json_encode($xmlContent), true);

        $count = $update = 0;

        if (isset($xmlArray['property']) && !empty($xmlArray['property']) && count($xmlArray['property'])) {
            $chunkSize = 50; // Process in smaller chunks
            $properties = array_chunk($xmlArray['property'], $chunkSize);

            foreach ($properties as $propertyBatch) {
                foreach ($propertyBatch as $item) {
                    $count++;
                    $buy = BuyPropertie::where('reference_number', $item['reference_number'])->first();
                    if ($buy) {
                        $update++;
                        // Skip update if the property is already updated
                        if (isset($item['@attributes']['last_update']) && $item['@attributes']['last_update'] <= $buy->updated_at) {
                            continue;
                        }
                    }

                    // Handle amenities efficiently
                    $amenities = explode(",", $item['private_amenities']);
                    $amenities_ids = array_map(function ($amenitie) {
                        $amenitie_data = Amenitie::firstOrCreate(
                            ['amenity_name' => $amenitie],
                            ['status' => '1']
                        );
                        return $amenitie_data->id;
                    }, $amenities);

                    // Extract longitude and latitude
                    $geopoints = isset($item['geopoints']) ? explode(",", $item['geopoints']) : [null, null];
                    $longitude = $geopoints[0] ?? null;
                    $latitude = $geopoints[1] ?? null;
                    $iframeUrl = "https://www.google.com/maps?q=$latitude,$longitude&hl=en&z=12&output=embed";
                    $iframe = "<iframe width='600' height='450' frameborder='0' style='border:0' src='$iframeUrl' allowfullscreen></iframe>";

                    // Generate a unique slug for the property
                    $slug = generateSlug($item['property_name'] ?? 'default_name' . "_buy", \App\Models\BuyPropertie::class);

                    // Create or update the property instance
                    $property = $buy ?: new BuyPropertie();

                    // Set property attributes
                    $property->status = "active";
                    $property->iframe = $iframe;
                    $property->name = $item['property_name'] ?? 'No name available';
                    $property->meta_title = $item['title_en'] ?? '';
                    $property->slug = $slug;
                    $property->address = ($item['location_lv1'] ?? '') . ', ' . ($item['location_lv2'] ?? '');
                    $property->google_maps_link = implode(', ', [
                        $item['location_lv1'] ?? '',
                        $item['location_lv2'] ?? '',
                        $item['location_lv3'] ?? '',
                        $item['location_lv4'] ?? '',
                        $item['location_lv5'] ?? ''
                    ]);
                    $property->area = $item['size'] ?? 'N/A';
                    $property->jacuzzi = $item['bathroom'] ?? 0;
                    $property->bed = $item['bedroom'] ?? 0;
                    $property->price = $item['price']['yearly'] ?? 0;
                    $property->amenities_id = implode(",", $amenities_ids);
                    $property->sale_price = $item['price']['yearly'] ?? 0;
                    $property->updated_at = $item['@attributes']['last_update'] ?? now();
                    $property->description = $item['description_en'] ?? 'No description available';
                    $property->reference_number = $item['reference_number'] ?? '';
                    $property->geopoints = $item['geopoints'] ?? '';
                    $property->XML = json_encode($item);

                    if (!$buy) {
                        // Handle agent creation or retrieval
                        if (isset($item['agent']) && !empty($item['agent']['email'])) {
                            $agent = Agent::firstOrCreate(
                                ['email' => $item['agent']['email']],
                                [
                                    'detail' => $item['agent']['title'],
                                    'mobile' => $item['agent']['phone'],
                                    'phone' => $item['agent']['phone'],
                                    'name' => $item['agent']['name'],
                                    'photo' => $this->downloadImage($item['agent']['photo']['url'] ?? null)
                                ]
                            );
                            $property->agent = $agent->id;
                        }

                        // Handle property type creation or retrieval
                        if ($item['category']) {
                            $property_type = PropertyType::firstOrCreate(
                                ['type_name' => $item['category'], 'property' => 'buy'],
                                ['status' => '1']
                            );
                            $property->category_id = $property_type->id;
                        }
                    }

                    // Save the property
                    $property->save();

                    // Handle property photos
                    if (!$buy && isset($item['photo']) && is_array($item['photo'])) {
                        foreach ($item['photo'] as $key => $pic) {
                            foreach ((array)$pic as $i_pic) {
                                $imagePath = $this->downloadImage($i_pic);
                                if ($imagePath) {
                                    $banner = new Banners();
                                    $banner->image_url = $imagePath;
                                    $banner->page_type = 'buy';
                                    $banner->property_id = $property->id;
                                    $banner->save();

                                    // Set the first image as featured
                                    if ($key == 0) {
                                        $property->featured_image = $imagePath;
                                    }
                                }
                            }
                        }
                    }

                    // Save the property again after handling the photos
                    $property->save();
                }
                // Optional sleep to avoid overwhelming the server
                sleep(1);
            }
        }

        return "Newly Inserted properties: $count and updated properties: $update";
    } else {
        return response()->json(['error' => 'Failed to retrieve XML data'], 500);
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
