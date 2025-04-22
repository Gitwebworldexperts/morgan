<?php
namespace App\Http\Controllers;

use App\Services\ApiRequestService;
use App\Models\Post;
use App\Models\PrivatePropertie;
use App\Models\ProjectPropertie;
use App\Models\InvestmentPropertie;
use App\Models\PaymentPlan;
use App\Models\Banners;
use DOMDocument;
use App\Models\Amenitie;
use DOMXPath;
use SoapClient;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;


class TestController extends Controller
{
    protected $apiRequestService;

    public function __construct(ApiRequestService $apiRequestService)
    {
        Config::set('app.debug', true);   
    }

    public function optimize(){
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        Artisan::call('view:cache');

        return response()->json([
            'status' => 'success',
            'message' => 'App optimized: route, config, and views cached.',
        ]);
    }


    public function index_out()
    {
        $filePath = public_path('download_blog_live_morgan.json');
        $jsonContent = file_get_contents($filePath);
        $arrayContent = json_decode($jsonContent, true);
    
        // Fetch all existing slugs once
        $existingSlugs = Post::pluck('slug')->toArray();
    
        $postsToInsert = [];
        foreach ($arrayContent as $item) {
            // Skip items with already existing slugs
            if (in_array($item['slug'], $existingSlugs)) {
                continue;
            }
    
            // Prepare the post data
            $postData = [
                'slug' => $item['slug'],
                'name' => $item['title'],
                'meta_title' => $item['meta_title'],
                'description' => $item['desc'],
                'keywords' => $item['keywords'],
                'meta_description' => $item['meta_desc'],
                'alt' => $item['alt'],
                'images' => $item['image'], // Temporarily store the image URL
                'language' => $item['language']
            ];
    
            // Accumulate posts for bulk insert later
            $postsToInsert[] = $postData;
    
            // If there's an image, download and save it
            if ($item['image']) {
                $imagePath = $this->downloadImage($item['image']);
                $postData['images'] = $imagePath; // Update image path after download
            }
        }
    
        // Bulk insert posts
        if (!empty($postsToInsert)) {
            Post::insert($postsToInsert);
        }
    
        // Optionally debug the inserted posts
        // dd($postsToInsert);
    }
    
    protected function downloadImage($imageUrl)
    {
        // Download the image
        $imageContents = Http::get($imageUrl)->body();
        
        // Get file extension and create new filename
        $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
        $timestamp = now()->timestamp;
        $newFileName = 'image_' . $timestamp . '.' . $extension;
        $imagePath = public_path('post/' . $newFileName);
        
        // Store the image file
        File::put($imagePath, $imageContents);
    
        // Return the relative image path
        return 'post/' . $newFileName;
    }
    


    public function testSoapRequest()
    {
        // Define constants (You may move these to .env and config files for better security)
        $wsdl = "https://api.smdservers.net/CCWs_3.5/CallCenterWs.asmx?WSDL";
        $corpCode = "CCTST";
        $locCode = "Demo";
        $corpLogin = "Administrator:::SAFENSOUZKBBHRJ6OHLP";
        $corpPass = "Demo";

        try {
            // Initialize SOAP Client
            $client = new SoapClient($wsdl, ['trace' => 1, 'exceptions' => true]);

            // Prepare Request Parameters
            $params = new \stdClass();
            $params->sCorpCode = $corpCode;
            $params->sLocationCode = $locCode;
            $params->sCorpUserName = $corpLogin;
            $params->sCorpPassword = $corpPass;

            // Call SOAP Method (Ensure 'SiteInformation' is the correct method)
            $response = $client->SiteInformation($params);

            // Extract response data
            $result = $response->SiteInformationResult ?? null;
            echo "<pre>";print_r($result);die;
            // Return response as JSON
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (Exception $e) {
            // Handle error
            dd($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function private_listing(){

        $filePath = public_path('development.json');
        $jsonContent = file_get_contents($filePath);
        $arrayContent = json_decode($jsonContent, true);   
            foreach($arrayContent as $item) 
            {                
                // dd($item);
                $isAlready = ProjectPropertie::where('slug',$item['slug'])->count();
                
                if($item['is_active'] == "Y" && !$isAlready){
                    $property = new ProjectPropertie();
                    $amenitiesText = $item['amenities'];
                    $amenities = [];
                    if(!$amenitiesText){
                        // continue;
                    }else{
                        $cleanText = html_entity_decode(strip_tags($amenitiesText));
                        $cleanText = str_replace("\xC2\xA0", ' ', $cleanText); 
                        $amenities = array_values(array_filter(array_map(function($line) {
                            $line = trim($line);
                            if (strpos($line, '*') === 0) {
                                return ltrim($line, '* '); // Remove "* " from the beginning
                            }
                            return null;
                        }, explode("\n", $cleanText))));
                        $amenities = array_filter($amenities);

                        $amenitiesIds = [];
                        foreach ($amenities as $amenitie) {
                            $amenitieData = Amenitie::firstOrCreate(['amenity_name' => $amenitie], ['status' => '1']);
                            $amenitiesIds[] = $amenitieData->id;
                        }
                        $property->amenities_id = implode(",", $amenitiesIds);
                    }

                    $property->slug = $item['slug'];
                    $property->bed = isset($item['bedroom']) && $item['bedroom'] !== '' ? (int) $item['bedroom'] : 0;
                    $property->jacuzzi = isset($item['bathroom']) && $item['bathroom'] !== '' ? (int) $item['bathroom'] : 0;
                    if(isset($item['squarefeet'])){
                        $property->area = (int) str_replace(',', '', $item['squarefeet']);
                    }
                    if($item['featured'] == "Y"){
                        $property->is_featured = 1; 
                    }
                    $latitude = $item['proj_latitude'];
                    $longitude = $item['proj_longitude'];
                    if($latitude && $longitude){
                        $property->iframe = "<iframe width='600' height='450' frameborder='0' style='border:0' src='https://www.google.com/maps?q=$latitude,$longitude&hl=en&z=12&output=embed' allowfullscreen></iframe>";
                    }
 
                    $property->address = $item['location_name']; 
                    $property->meta_title = $property->name = $item['location_name']; 
                    $property->meta_description2 = $item['meta_desc']; 
                    $property->description = $item['location_details'] . " <br> ". $item['lifestyle'];
                    if($item['local_community']){
                        $property->information_heading = "Local Community";
                        $property->information_description = $item['local_community'];                    
                    }
                    $property->save();
                    if (!empty($item['payment_titles']) && !empty($item['payment_statuses']) && !empty($item['payment_percentages'])) {
                        $payment_titles = explode(", ", $item['payment_titles']);
                        $payment_statuses = explode(", ", $item['payment_statuses']);
                        $payment_percentages = explode(", ", $item['payment_percentages']);
                    
                        for ($i = 0; $i < count($payment_titles); $i++) {
                            $paymentPlan = new PaymentPlan();
                            $paymentPlan->name = $payment_titles[$i] ?? "";
                            $paymentPlan->percentage = isset($payment_percentages[$i]) ? (int) rtrim($payment_percentages[$i], '%') : 0;
                            $paymentPlan->detail = $payment_statuses[$i] ?? "";
                            $paymentPlan->project_id = $property->id;
                            $paymentPlan->save();
                        }
                    }
                    
                    if ($item['gallery_images']) {
                        $array = explode(", ", $item['gallery_images']);
                        if(is_array($array) && count($array)){
                            foreach($array as $key => $image ){
                                if($key == 0){
                                    $imageUrl = 'https://www.morgansrealty.com/public/uploads/gallery/'.$image;
                                    $imageContents = Http::get($imageUrl)->body();            
                                    $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
                                    $timestamp = now()->timestamp;
                                    $newFileName = 'featured_images_' . $timestamp . '.' . $extension;
                                    $imagePath = 'featured_images/' . $newFileName;
                                    File::put($imagePath, $imageContents);
                                    $property->update([
                                        'featured_image' =>  $imagePath, // Store the relative path
                                    ]);    
                                }else{
                                    $imageUrl = 'https://www.morgansrealty.com/public/uploads/gallery/'.$image;
                                    $imageContents = Http::get($imageUrl)->body();            
                                    $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
                                    $timestamp = now()->timestamp;
                                    $newFileName = 'featured_images_' . $timestamp . '.' . $extension;
                                    $imagePath = 'images/' . $newFileName;
                                    File::put($imagePath, $imageContents);

                                    $banner = new Banners();
                                    $banner->image_url = $imagePath;
                                    $banner->page_type = 'project'; // Set the appropriate page_id if needed
                                    $banner->property_id = $property->id; // Associate with the newly created property
                                    $banner->save();
                                }
                            }
                        }                        
                    }
                    dd($property);
                }
            }
    }

    public function index(){
        $this->private_listing();
        die;
        $filePath = public_path('download_blog_live_morgan.json');
        $jsonContent = file_get_contents($filePath);
        $arrayContent = json_decode($jsonContent, true);
        foreach($arrayContent as $item){
            if(Post::where('slug', $item['slug'])->exists()){
                continue;
            }
            $item['desc'] = str_replace(["\n", "\t", '&nbsp;'], '', $item['desc']);


            $post = Post::create([            
                'slug'	=> $item['slug'],
                'name' => $item['title'],
                'meta_title' => $item['meta_title'],
                'description' => $item['desc'],
                'keywords' => $item['keywords'], 
                'meta_description' => $item['meta_desc'],
                'alt' => $item['alt'], 
                'images' => $item['image'],
                // $item['banner_image'];
                'language' => $item['language']
            ]);

            if ($item['image'] || $item['banner_image']) {
                
                $imageUrl = 'https://www.morgansrealty.com/public/uploads/contents/'.$item['banner_image'] ?? $item['image'];
                $imageContents = Http::get($imageUrl)->body();            
                $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
                $timestamp = now()->timestamp;
                $newFileName = 'image_' . $timestamp . '.' . $extension;
                $imagePath = 'post/' . $newFileName;
                File::put($imagePath, $imageContents);
                $post->update([
                    'images' =>  $newFileName, // Store the relative path
                ]);
            }
            dd($post);
        }
    }


    public function sendRequest()
    {
        $data = [
            "companyId" => "eu20_001",
            // "sourcePlatform" => "MICROSITE", // non required
            // "leadSource" => "Website", // non required
            // "assignmentKey" => "uk_lead", // non required
            "userInfo" => [
                "submitDateTime" => "2024-12-30T10:32:51.000+08:00",
                "sourceUniqueId" => "buy-1",
                "firstName" => "Yesvant", // required
                "lastName" => "Alaria",  // required
                "phone" => "+91 9653720289", // required
                "email" => "yesvantalaria09@gmail.com", // required
                "customerCompany" => "BAT",
                "customerCompanySize" => 9999,
                "jobTitle" => "Team Lead",
                "message" => "First Test submit lead",
                "listingId" => "mir-RD8243", // required
                "allowEmailPromotion" => true,
                "subscribe" => true,
                "trackingItems" => [
                    [
                        "listingId" => "mir-RD8243", // required
                        "sourceUniqueId" => "buy-1", // required
                        "trackingDateTime" => "2024-01-09T10:32:51.000+08:00",
                        "spentTime" => 10
                    ]
                ],
                "favoriteItems" => [
                    [
                        "listingId" => "mir-RD8243",
                        "sourceUniqueId" => "rent-3",
                        "favorite" => true,
                        "trackingDateTime" => "2024-01-09T10:32:51.000+08:00",
                        "spentTime" => 10
                    ]
                ],
                "extRemark" => "{}"
            ]
        ];
        

        // Send POST request
        $response = $this->apiRequestService->sendPostRequest('https://eu20.propertyraptor.com/hornet/portal/createLead', $data);

        // Return or process the response
        // return 
        $response = response()->json($response);
        dd($response);
    }


    public function scraping(){
        // Step 1: Fetch the web page
        $url = 'https://www.morgansrealty.com/report/best-branded_residences_to_invest/'; // Replace with the target URL
        // $url = 'https://www.morgansrealty.com/report/brandedresidencesh1/'; // Replace with the target URL
    

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html_content = curl_exec($ch);
        curl_close($ch);
    
        if ($html_content === false) {
            die('Error fetching the page');
        }
    
        // Step 2: Parse the HTML content
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($html_content, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();
    
        // Step 3: Extract specific data
        $xpath = new DOMXPath($dom);
    
        // Extract data from .bannerContent section
        $bannerContent = $xpath->query('//div[contains(@class, "bannerContent")]');
        $subheading = '';
        $heading = '';
        $description = '';
        $mediaHeading = '';
    
        if ($bannerContent->length > 0) {
            $pTag = $xpath->query('.//p', $bannerContent->item(0));
            if ($pTag->length > 0) {
                $subheading = trim($pTag->item(0)->textContent);
            }
    
            $h1Tag = $xpath->query('.//h1', $bannerContent->item(0));
            if ($h1Tag->length > 0) {
                $heading = trim($h1Tag->item(0)->textContent);
            }
        }
    
        // Extract description from <p class="m-0"> inside .ContentSecion
        $contentSection = $xpath->query('//section[contains(@class, "ContentSecion")]');
        if ($contentSection->length > 0) {
            $descriptionTag = $xpath->query('.//p[contains(@class, "m-0")]', $contentSection->item(0));
            if ($descriptionTag->length > 0) {
                $description = trim($descriptionTag->item(0)->textContent);
            }
        }
    
        // Extract media heading from .mediaHeading section
        $mediaHeadingSection = $xpath->query('//div[contains(@class, "mediaHeading")]//h3');
        if ($mediaHeadingSection->length > 0) {
            $mediaHeading = html_entity_decode(trim($mediaHeadingSection->item(0)->textContent), ENT_QUOTES, 'UTF-8');
        }
    
        // Extract anchor text within .panel-group
        $links = $xpath->query('//div[@class="panel-group"]//a');
        $linkArray = [];
        foreach ($links as $link) {
            $linkArray[] = trim($link->textContent); // Add anchor tag text
        }
    
        // Extract anchor text within .panel-group row
        $links2 = $xpath->query('//div[@class="panel-group row"]//a');
        $linkArray2 = [];
        foreach ($links2 as $link) {
            $linkArray2[] = trim($link->textContent); // Add anchor tag text
        }
    
        // Extract paragraph text inside .panel-group (or #accordion) panels
        $paragraphs = $xpath->query('//div[@class="panel-group"]//div[contains(@class, "panel-body")]//p');
        $paragraphArray = [];
        foreach ($paragraphs as $p) {
            $paragraphArray[] = trim($p->textContent); // Add <p> tag text
        }
    
        // Extract paragraph text inside .panel-group row (or #accordion) panels
        $paragraphs2 = $xpath->query('//div[contains(@id, "accordion")]//p');

        $answerArray = [];
        foreach ($paragraphs2 as $s) {
            $answerArray[] = trim($s->textContent); // Add <p> tag text
        }
    

        // Extract media heading from FormBox > mediaHeading > h3
        $formBoxMediaHeadingSection = $xpath->query('//div[contains(@class, "FormBox")]//div[contains(@class, "mediaHeading")]//h3');
        if ($formBoxMediaHeadingSection->length > 0) {
            $formBoxMediaHeading = html_entity_decode(trim($formBoxMediaHeadingSection->item(0)->textContent), ENT_QUOTES, 'UTF-8');
        } else {
            $formBoxMediaHeading = ''; // If no such section exists
        }

        
       // Step 1: Parse the HTML content using DOMDocument and XPath
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($html_content, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        // Step 2: Extract the first image src within the ContentSecionImage class
        $imageSrc = '';
        $imageSection = $xpath->query('//div[contains(@class, "ContentSecionImage")]//img');

        if ($imageSection->length > 0) {
            $imageSrc = $imageSection->item(0)->getAttribute('src');  // Get the src attribute of the first image
        }


        $link = $xpath->query('//a[contains(@class, "whatsapp-btn")]');

        $hrefPath = '';
        if ($link->length > 0) {
            $hrefPath = $link->item(0)->getAttribute('href');
        }

        preg_match('/phone=(\d+)$/', $hrefPath, $matches);

        // Get the last mobile number from the URL
        $mobileNumber = isset($matches[1]) ? $matches[1] : 'No phone number found';

        $parsedUrl = parse_url($url, PHP_URL_PATH);

        // Get the last slug from the path by trimming slashes and splitting by '/'
        $pathParts = array_filter(explode('/', trim($parsedUrl, '/')));
        $lastSlug = end($pathParts);


        // Step 4: Store data in JSON format
        $data = [
            'whatsapp' => $mobileNumber,
            'slug' => $lastSlug,
            "left_image" => $url.$imageSrc,
            'subheading' => $subheading,
            'heading' => $heading,
            'description' => $description,
            'media_heading' => $mediaHeading,
            'anchor_texts' => $linkArray,
            'seo_text' => $paragraphArray,
            'question' => $linkArray2,
            'paragraph_texts' => $answerArray, // Merge paragraph arrays
            'form_heading' => $formBoxMediaHeading
        ];
    
        // Save to JSON file
        file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));
    
        echo "Data has been saved to data.json";
        die;
    }
    


}
