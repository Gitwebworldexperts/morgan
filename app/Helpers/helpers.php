<?php
use App\Models\HeaderSections;
use App\Models\FooterSections;
use App\Models\Faqs;
use App\Models\Countries;


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
    $footerSections = Faqs::orderBy('id', 'desc')->get();
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
                <button type="submit" class="green-btn submit-btn">Submit <img src="/img/arrow-right3.svg" alt=""></button>
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