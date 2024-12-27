<?php
use App\Models\HeaderSections;
use App\Models\FooterSections;
use App\Models\Faqs;
use App\Models\Countries;
use App\Models\PrivatePropertie;
use App\Models\PropertyType;
use App\Models\Testimonial;
use App\Models\Gallery;
use App\Models\Agent;
use App\Models\Community;
use App\Models\Wishlist;
use App\Models\HomePage;


use App\Models\RentPropertie;
use App\Models\ProjectPropertie;
use App\Models\InternationalPropertie;
use App\Models\BuyPropertie;
use App\Models\BrandedPropertie;
use App\Models\InvestmentPropertie;



use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;


if (!function_exists('siteLogo')) {
    /**
     * get site url 
     *
     * @param  
     * @return provide site logo url
     */
    function siteLogo()
    {
        $headerSections = HeaderSections::first();
        return isset($headerSections->logo_url) ? $headerSections->logo_url : 'img/logo.svg' ;
    }
}

  function getWhishList()
    {

$slugs = Wishlist::where('user_id', Auth::id())
                             ->pluck('product_slug') // Get only the 'product_slug' column
                             ->toArray();

        return isset($slugs) ? $slugs : [] ;
    }

if (!function_exists('siteFooterLogo')) {
    /**
     * get site url 
     *
     * @param  
     * @return provide site logo url
     */
    function siteFooterLogo()
    {
        $headerSections = FooterSections::first();
        return isset($headerSections->logo_url) ? $headerSections->logo_url : 'img/logo.svg' ;
    }
}

if (!function_exists('headerNav')) {
    /**
     * get navigation menus 
     *
     * @param  
     * @return provide site logo url
     */
    function headerNav()
    {
        $menu = "";
        $headerSections = HeaderSections::first();
        if(isset($headerSections) && !empty($headerSections)){
            $headerSections = json_decode($headerSections->navigation_links, true);
            foreach ($headerSections['urls'] as $url => $name) {
                $menu .=  '<li class="nav-item"> <a class="nav-link" href="'.$url.'">'.$name.'</a> </li>';
            }
        }
        return $menu;
    }
}

if (!function_exists('getHeaderSection')) {
    /**
     * get site url 
     *
     * @param  
     * @return get Header Section
     */
    function getHeaderSection()
    {
        $headerSections = HeaderSections::first();
        return $headerSections;
    }
}

if (!function_exists('getFooterSection')) {
    /**
     * get site url 
     *
     * @param  
     * @return get footer Section
     */
    function getFooterSection()
    {
        $footerSections = FooterSections::first();
        return $footerSections;
    }
}

if (!function_exists('getFaqs')) {
    /**
     * get site url 
     *
     * @return get footer Section
     * @param  $page_name = null
     */
    function getFaqs($page_name = '')
    {
        if($page_name){
            $footerSections = Faqs::where('page',$page_name)->orderBy('id', 'desc')->get();
        }else{
            $footerSections = Faqs::orderBy('id', 'desc')->get();            
        }
        return $footerSections;
    }
}

if (!function_exists('getCountry')) {
    /**
     * get country DropDown 
     *  
     *
     * @param  $name,$id,$selected = null,$placeholder = ''
     * @return Country Dropdown Html 
     */
    function getCountry($name, $id, $selected = '', $placeholder = '')
    {
        $selectBox = '<select class="form-control select2" name="' . htmlspecialchars($name) . '" id="' . htmlspecialchars($id) . '">
                        <option value="">' . ($placeholder ? htmlspecialchars($placeholder) : "Select a country") . '</option>';
        
        $countries = Countries::all();
        
        if (isset($countries) && !empty($countries)) {
            foreach ($countries as $item) {
                $isSelected = old("country_id", $item->id) == $selected ? 'selected' : '';
                $selectBox .= '<option value="' . htmlspecialchars($item->id) . '" ' . $isSelected . '>' . htmlspecialchars($item->name) . '</option>';
            }
        }
        
        $selectBox .= '</select>';
        return $selectBox;
    }

}
if (!function_exists('getImage')) {
    /**
     * Generate HTML for image upload.
     * 
     * Created by: Yesvant Alaria
     * Created at: 20 Sep 2024
     *
     * @param string $name The name attribute for the input.
     * @param string $id The id attribute for the input.
     * @param string $className CSS class for the input.
     * @param string $url (optional) URL of an already uploaded image.
     * @return string HTML for image upload and preview.
     */
    function getImage($name, $id, $className, $url = "")
    {
        // Create input for image upload and preview container
        $imageHtml = '
            <div class="image-upload">
                <input type="file" accept="image/*" name="' . htmlspecialchars($name) . '" id="' . htmlspecialchars($id) . '" class="' . htmlspecialchars($className) . '" onchange="previewImage(event, this)">
                <div class="image-preview">
                    <img id="preview-' . htmlspecialchars($id) . '" src="" alt="Image Preview" style="display: none;">';


        // Add uploaded image if URL is provided
        if (!empty($url)) {
            $imageHtml .= '<img class="uploaded_logo old pr" src="' . htmlspecialchars(asset($url)) . '">';
        }

        $imageHtml .= '</div>
            </div>';
        return $imageHtml;
    }
}


if (!function_exists('createButtonUrl')) {
    /**
     * get createButtonUrl 
     * created By: Yesvant Alaria
     * Ceated at: 20 Sep 2024
     *
     * @param  name, Button Name, Button Url
     * @return Image Html 
     */
    function getButtonUrl($name, $button_name = "", $button_url = "", $savedJson = '', $index = 0)
    {
        $jsonData = [];

        // Decode JSON and retrieve button data if available
        if (!empty($savedJson)) {
            $jsonData = json_decode($savedJson, true);
            if (isset($jsonData[$index])) {
                $jsonData = $jsonData[$index];
            }
        }

        // Set button name and URL from saved JSON data, or use provided values
        $buttonName = $jsonData['buttonName'] ?? $button_name;
        $buttonUrl = $jsonData['buttonUrl'] ?? $button_url;

        // Generate HTML output
        return '<div class="row">
            <div class="form-group col-md-6">
                <label>Button</label>
                <input type="text" class="form-control" name="' . htmlspecialchars($name) . '" 
                    id="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($buttonName) . '" placeholder="Button Name">
            </div>
            <div class="form-group col-md-6">
                <label>Url:</label>
                <input type="text" class="form-control" name="' . htmlspecialchars($name) . '_2" 
                    id="' . htmlspecialchars($name) . '_2" value="' . htmlspecialchars($buttonUrl) . '" placeholder="Button Url">
            </div>
        </div>';
    }


}

if (!function_exists('contactForm')) {
    /**
     * get createButtonUrl 
     * created By: Yesvant Alaria
     * Ceated at: 20 Sep 2024
     *
     * @param  name, Button Name, Button Url
     * @return Image Html 
     */
    function contactForm($name = "RegisterYourInterest", $pageName = null, $pageId = null)
    {
        $pageName = $pageName ?? request()->route()->getName();
        $pageId = $pageId ?? request()->route('id'); // assuming 'id' is a parameter in the route
    
        return `<h3 class="mb-2">Register Your Interest</h3>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="contactForm" action="{{ route('intrest.submit') }}" method="POST">
          @csrf
          <div class="form-group">
              <label>Full Name</label>
              <input class="form-control" name="fullName" type="text" placeholder="John Doe" required>
          </div>
          <div class="form-group">
              <label>Email</label>
              <input class="form-control" name="email" type="email" placeholder="example@gmail.com" required>
          </div>
          <div class="form-group">
              <label>Contact Number</label>
              <input class="form-control" name="contactNumber" type="text" placeholder="+91 2344 34332" required>
          </div>
          <div class="form-group">
              <label>Message</label>
              <textarea class="form-control" name="message" placeholder="Enter your message..." required></textarea>
          </div>
          <input type="hidden" name="pageName" value="${pageName}">
          <input type="hidden" name="pageId" value="${pageId}">
          <button type="submit" class="green-btn submit-btn">Submit</button>
      </form>`;
    }
    

}

if (!function_exists('devContactForm')) {
    /**
     * get createButtonUrl 
     * created By: Yesvant Alaria
     * Ceated at: 20 Sep 2024
     *
     * @param  name, Button Name, Button Url
     * @return Image Html 
     */
    function devContactForm($name = "RegisterYourInterest", $pageName = null, $pageId = null)
    {
        $pageName = $pageName ?? request()->route()->getName();
        $pageId = $pageId ?? request()->route('id'); // assuming 'id' is a parameter in the route
    
        return `
        <form id="contactForm" action="{{ route('intrest.submit') }}" method="POST">
          @csrf
          <div class="form-group">
              <label>Full Name</label>
              <input class="form-control" name="fullName" type="text" placeholder="John Doe" required>
          </div>
          <div class="form-group">
              <label>Email</label>
              <input class="form-control" name="email" type="email" placeholder="example@gmail.com" required>
          </div>
          <div class="form-group">
              <label>Contact Number</label>
              <input class="form-control" name="contactNumber" type="text" placeholder="+91 2344 34332" required>
          </div>
          <input type="hidden" name="pageName" value="${pageName}">
          <input type="hidden" name="pageId" value="${pageId}">
          <button type="submit" class="green-btn submit-btn">Submit</button>
      </form>`;
    }
    

}


function generateSlug($name,$model_name)
{
    // Step 1: Convert the name to a slug
    $slug = Str::slug($name);

    // Step 2: Check if the slug exists in the database
    $count = $model_name::where('slug', 'like', $slug.'%')->count();

    // Step 3: If the slug exists, append a unique number
    if ($count > 0) {
        $slug = $slug . '-' . ($count + 1); // Append a unique number
    }

    return $slug;
}


function renderInterestForm($form_name = "RegsiterYourInterest",$pageId = "",$page_name = "") {
    // $form_name = ['RegsiterYourInterest','apply_job','listing_form'];
    if($form_name == "apply_job"){
        return '<form  action="' . route('application.store') . '" method="POST" enctype="multipart/form-data">
        ' . csrf_field() . '
            <div class="form-group">
                <label>Full Name</label>
                <input class="form-control" placeholder="John Doe" name="full_name" type="text" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" placeholder="example@gmail.com" name="email" type="email" required>
            </div>
            <div class="form-group">
                <label>Experience</label>
                <input class="form-control" placeholder="" name="experience" type="text" required>
            </div>
            <div class="form-group">
                <label>Contact Number</label>
                <input class="form-control" placeholder="John Doe" name="contact_number" type="text" required>
            </div>
            <div class="form-group">
                <label>Add Resume</label>
                <input class="form-control" name="resume" type="file">
            </div>
            <div class="form-group">
                <button type="submit" class="green-btn submit-btn">Submit <img src="/img/arrow-right3.svg" class=""></button>
            </div>
        </form>';
    } elseif($form_name == "listing_form")
    {
                            return '<form action="' . route('list-with-us.store') . '" method="POST">
' . csrf_field() . '
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
                <label>Full Name</label>
                <input class="form-control" placeholder="John Doe" name="full_name" type="text" required>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" placeholder="example@gmail.com" name="email" type="email" required>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
                <label>Contact Number</label>
                <input class="form-control" placeholder="23543 4343 3433" name="contact_number" type="text" required>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
                <label>Property Type</label>
                <select class="form-control" name="property_type" required>
                    <option value="" disabled selected>Select Property Type</option>
                    <option value="Residential">Residential</option>
                    <option value="Commercial">Commercial</option>
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
                <label>No. of Bedrooms</label>
                <input class="form-control" placeholder="Enter Bedrooms" name="bedrooms" type="number" min="0">
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
                <label>Area</label>
                <input class="form-control" placeholder="Enter Area" name="area" type="text">
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label>Building Name</label>
                <input class="form-control" placeholder="Enter Building Name" name="building_name" type="text">
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <p class="mb-0 mt-4">
                    <input type="checkbox" name="consent" required>
                    Consent to submit all details and agree to Morgan'."'".'s <a href="#" class="link-btn">Privacy Policy</a>.
                </p>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <button type="submit" class="green-btn submit-btn">Submit <img class="d-none" src="/img/arrow-right3.svg" alt=""></button>
            </div>
        </div>
    </div>
</form>
';
        
    } else{
        return '<form id="contactForm" action="' . route('intrest.submit') . '" method="POST">
        ' . csrf_field() . '
            <div class="form-group">
                <label>Full Name</label>
                <input class="form-control" name="fullName" type="text" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" type="email" placeholder="example@gmail.com" required>
            </div>
            <div class="form-group">
                <label>Contact Number</label>
                <input class="form-control" name="contactNumber" type="text" placeholder="+91 2344 34332" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" placeholder="Enter your message..." required></textarea>
            </div>
            <button type="submit" class="green-btn submit-btn">Submit</button>
        </form>
    ';
    }

}


if (! function_exists('testimonial')) {
    function testimonial($count = 3)
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->take($count)->get();
        return View::make('Helper.testimonial_slider')->with('testimonials', $testimonials)->render();
    }
}


if (! function_exists('addCommunity')) {
    function addCommunity($selected = '')
    {
        $communities = Community::all();
        return View::make('Helper.communityDropdown')->with(['communities'=> $communities,'selected' =>$selected])->render();
    }
}


if (! function_exists('addMetaTag')) {
    function addMetaTag($meta_title = "",$meta_description = "")
    {
        return View::make('Helper.addMetaTag')->with(['meta_title'=> $meta_title,'meta_description' =>$meta_description])->render();
    }
}



if (! function_exists('mediaSection')) {
    function mediaSection($count = 'all',$new_heading = '')
    {
        if($count == 'all'){
            $gallery = Gallery::orderBy('created_at', 'desc')->get();
        }else{
            $gallery = Gallery::orderBy('created_at', 'desc')->take($count)->get();
        }
        
        return View::make('Helper.media')->with(['gallery'=>$gallery,'new_heading'=>$new_heading])->render();
    }
}

if (! function_exists('reportmediaSection')) {
    function reportmediaSection($count = 'all',$new_heading = '')
    {
        if($count == 'all'){
            $gallery = Gallery::orderBy('created_at', 'desc')->get();
        }else{
            $gallery = Gallery::orderBy('created_at', 'desc')->take($count)->get();
        }
        
        return View::make('Helper.report_media')->with(['gallery'=>$gallery,'new_heading'=>$new_heading])->render();
    }
}

if (! function_exists('teamSlider')) {
    function teamSlider($count = "all")
    {
        if($count == 'all'){
            $team = Agent::orderBy('created_at', 'desc')->get();
        }else{
            $team = Agent::orderBy('created_at', 'desc')->take($count)->get();
        }
        return View::make('Helper.team_slider')->with(['team'=>$team])->render();
    }
}

if (! function_exists('descriptionWithImages')) {
    function descriptionWithImages($description ="")
    {
        $descriptionWithImages = preg_replace('/!\[\]\((.*?)\)/', '<div class="thmb-img"><img src="$1" alt="Image" class="w-100" /></div>', $description);
        return $descriptionWithImages;
    }
}


if (!function_exists('searchBox')) {
    /**
     * Generate HTML for search Box.
     * 
     * Created by: Yesvant Alaria
     * Created at: 18 Nov 2024
     *
     * @param string $name The name attribute for the input.
     * @param string $id The id attribute for the input.
     */
    function searchBox()
    {
        $property_type = PropertyType::all()->groupBy('property');
        $home = HomePage::orderBy('id','desc')->first();
        return View::make('Helper.commonSearch')->with(['home'=>$home,'property_type'=>$property_type])->render();
    }
}



if (!function_exists('innerSearchBox')) {
    /**
     * Generate HTML for search Box.
     * 
     * Created by: Yesvant Alaria
     * Created at: 18 Nov 2024
     *
     * @param string $name The name attribute for the input.
     * @param string $id The id attribute for the input.
     */
    function innerSearchBox($searchData = [])
    {   
        $old_property_type = '';
        if(isset($searchData['property_type']) && !empty($searchData['property_type']) && $searchData['property_type']){
            $old_property_type = $searchData['property_type'];
        }$property_type = PropertyType::all()->groupBy('property');


        return View::make('Helper.innerSearch')->with(['old_property_type'=>$old_property_type,'property_type'=>$property_type,'searchData'=>$searchData])->render();
    }
}


if (!function_exists('getPropertyDeatil')) {
    /**
     * get site url 
     *
     * @return get Property Detail
     * @return property type, property id
     * @param  $property_type = null,$property_id = null 
     */
    function getPropertyDeatil($property_type = '',$property_id = "",$column_name = "")
    {
    	if(!$property_type || !$property_id){
    		return '';
    	}
    	    	
    	$propertyTypes = [
            'rent' => RentPropertie::class,
            'project' => ProjectPropertie::class,
            'private' => PrivatePropertie::class,
            'international' => InternationalPropertie::class,
            'sales' => BuyPropertie::class,
            'branded' => BrandedPropertie::class,
            'invest' => InvestmentPropertie::class
        ];
        
        if (array_key_exists($property_type, $propertyTypes)) {
        	$properties = $propertyTypes[$property_type]::where('id',$property_id)->first();
 		if($column_name && $properties){
 			return $properties->$column_name;
 		}
        	return $properties;
        }
                
        return "";
    }
}


