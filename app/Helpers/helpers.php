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
        $selectBox = '<select class="form-control" name="' . htmlspecialchars($name) . '" id="' . htmlspecialchars($id) . '">
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



