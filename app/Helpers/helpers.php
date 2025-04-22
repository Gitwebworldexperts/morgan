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
use App\Models\Option;

use App\Models\RentPropertie;
use App\Models\ProjectPropertie;
use App\Models\InternationalPropertie;
use App\Models\BuyPropertie;
use App\Models\BrandedPropertie;
use App\Models\InvestmentPropertie;
use App\Models\Banners;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;


if (!function_exists('siteLogo')) {
    function siteLogo()
    {
        try {
            return Cache::remember('site_logo_url', 600, function () {
                $headerSections = HeaderSections::first();
                return isset($headerSections->logo_url) ? $headerSections->logo_url : 'img/logo.svg';
            });
        } catch (\Exception $e) {
            Log::error("Error fetching site logo: " . $e->getMessage());
            return 'img/logo.svg'; // Fallback logo on failure
        }
    }
}

function getWhishList()
{
    try {
        $slugs = Wishlist::where('user_id', Auth::id())
            ->pluck('product_slug')
            ->toArray();
        return isset($slugs) ? $slugs : [];
    } catch (\Exception $e) {
        Log::error("Error fetching wishlist: " . $e->getMessage());
        return []; // Return empty array on error
    }
}

if (!function_exists('siteFooterLogo')) {
    function siteFooterLogo()
    {
        try {
            return Cache::remember('site_footer_logo_url', 600, function () {
                $footerSections = FooterSections::first();
                return isset($footerSections->logo_url) ? $footerSections->logo_url : 'img/logo.svg';
            });
        } catch (\Exception $e) {
            Log::error("Error fetching footer logo: " . $e->getMessage());
            return 'img/logo.svg'; // Fallback logo on failure
        }
    }
}


if (!function_exists('headerNav')) {
    function headerNav()
    {
        try {
            return Cache::remember('site_header_navigation', 600, function () {
                $menu = '';
                $headerSections = HeaderSections::first();
                
                if (isset($headerSections) && !empty($headerSections)) {
                    $navLinks = json_decode($headerSections->navigation_links, true);
                    if (isset($navLinks['urls']) && is_array($navLinks['urls'])) {
                        foreach ($navLinks['urls'] as $url => $name) {
                            if (isset($name[0]) && isset($name[1]) && $name[1] == "1") {
                                $menu .= '<li class="nav-item"> <a class="nav-link" href="' . $url . '">' . $name[0] . '</a> </li>';
                            }
                        }
                    }
                }

                return $menu;
            });
        } catch (\Exception $e) {
            Log::error("Error fetching header navigation: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}


if (!function_exists('getHeaderSection')) {
    function getHeaderSection()
    {
        try {
            return Cache::remember('header_section_data', 600, function () {
                return HeaderSections::first();
            });
        } catch (\Exception $e) {
            Log::error("Error fetching header section: " . $e->getMessage());
            return null; // Return null on error
        }
    }
}


if (!function_exists('getFooterSection')) {
    function getFooterSection()
    {
        try {
            return Cache::remember('footer_section_data', 600, function () {
                return FooterSections::first();
            });
        } catch (\Exception $e) {
            Log::error("Error fetching footer section: " . $e->getMessage());
            return null; // Return null on error
        }
    }
}


if (!function_exists('getFaqs')) {
    function getFaqs($page_name = '')
    {
        try {
            $cacheKey = $page_name ? "faqs_page_{$page_name}" : 'faqs_all';

            return Cache::remember($cacheKey, 600, function () use ($page_name) {
                if ($page_name) {
                    return Faqs::where('page', $page_name)->orderBy('id', 'desc')->get();
                } else {
                    return Faqs::orderBy('id', 'desc')->get();
                }
            });
        } catch (\Exception $e) {
            Log::error("Error fetching FAQs: " . $e->getMessage());
            return collect(); // Return empty collection on error
        }
    }
}


if (!function_exists('getCountry')) {
    function getCountry($name, $id, $selected = '', $placeholder = '')
    {
        try {
            $selectBox = '<select class="form-control select2" name="' . htmlspecialchars($name) . '" id="' . htmlspecialchars($id) . '">
                            <option value="">' . ($placeholder ? htmlspecialchars($placeholder) : "Select a country") . '</option>';

            $countries = Cache::remember('countries_all_list', 86400, function () {
                return Countries::all();
            });

            if ($countries && $countries->isNotEmpty()) {
                foreach ($countries as $item) {
                    $isSelected = old("country_id", $item->id) == $selected ? 'selected' : '';
                    $selectBox .= '<option value="' . htmlspecialchars($item->id) . '" ' . $isSelected . '>' . htmlspecialchars($item->name) . '</option>';
                }
            }

            $selectBox .= '</select>';
            return $selectBox;
        } catch (\Exception $e) {
            Log::error("Error fetching countries: " . $e->getMessage());
            return '<select class="form-control select2" name="' . htmlspecialchars($name) . '" id="' . htmlspecialchars($id) . '">
                        <option value="">' . ($placeholder ? htmlspecialchars($placeholder) : "Select a country") . '</option>
                    </select>'; // Return empty select on error
        }
    }
}


if (!function_exists('getImage')) {
    function getImage($name, $id, $className, $url = "")
    {
        try {
            $imageHtml = '
                <div class="image-upload">
                    <input type="file" accept="image/*" name="' . htmlspecialchars($name) . '" id="' . htmlspecialchars($id) . '" class="' . htmlspecialchars($className) . '" onchange="previewImage(event, this)">
                    <div class="image-preview">
                        <img id="preview-' . htmlspecialchars($id) . '" src="" alt="Image Preview" style="display: none;">';
            if (!empty($url)) {
                $imageHtml .= '<img class="uploaded_logo old pr" src="' . htmlspecialchars(asset($url)) . '">';
            }
            $imageHtml .= '</div>
                </div>';
            return $imageHtml;
        } catch (\Exception $e) {
            Log::error("Error generating image upload HTML: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}

if (!function_exists('getButtonUrl')) {
    function getButtonUrl($name, $button_name = "", $button_url = "", $savedJson = '', $index = 0)
    {
        try {
            $jsonData = [];
            if (!empty($savedJson)) {
                $jsonData = json_decode($savedJson, true);
                if (isset($jsonData[$index])) {
                    $jsonData = $jsonData[$index];
                }
            }
            $buttonName = $jsonData['buttonName'] ?? $button_name;
            $buttonUrl = $jsonData['buttonUrl'] ?? $button_url;
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
        } catch (\Exception $e) {
            Log::error("Error generating button URL HTML: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}

if (!function_exists('contactForm')) {
    function contactForm($name = "RegisterYourInterest", $pageName = null, $pageId = null)
    {
        try {
            $pageName = $pageName ?? request()->route()->getName();
            $pageId = $pageId ?? request()->route('id');
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
        } catch (\Exception $e) {
            Log::error("Error generating contact form: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}

if (!function_exists('devContactForm')) {
    function devContactForm($name = "RegisterYourInterest", $pageName = null, $pageId = null)
    {
        try {
            $pageName = $pageName ?? request()->route()->getName();
            $pageId = $pageId ?? request()->route('id');
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
        } catch (\Exception $e) {
            Log::error("Error generating dev contact form: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}

function generateSlug($name, $model_name)
{
    try {
        $slug = Str::slug($name);
        $count = $model_name::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        return $slug;
    } catch (\Exception $e) {
        Log::error("Error generating slug: " . $e->getMessage());
        return Str::slug($name); // Return original slug on error
    }
}

function renderInterestForm($form_name = "RegsiterYourInterest", $pageId = "", $page_name = "")
{
    try {
        if ($form_name == "apply_job") {
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
        } elseif ($form_name == "listing_form") {
            return '<form action="' . route('list-with-us.store') . '" method="POST">
            ' . csrf_field() . '
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="form" style="display:none;">
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
                                <label><input type="checkbox" name="consent" required>
                                Consent to submit all details and agree to Morgan'."'".'s <a target="_blank" href="https://myprojectdemonstration.net/development/morgan/web/contents/view/privacy-policy-2026" class="link-btn">Privacy Policy</a>.</label>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <button type="submit" class="green-btn submit-btn">Submit <img class="d-none" src="/img/arrow-right3.svg" alt=""></button>
                        </div>
                    </div>
                </div>
            </form>';
        } else {
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
            </form>';
        }
    } catch (\Exception $e) {
        Log::error("Error rendering interest form: " . $e->getMessage());
        return ''; // Return empty string on error
    }
}

if (!function_exists('testimonial')) {
    function testimonial($count = 3)
    {
        try {
            $cacheKey = "testimonial_slider_count_{$count}";

            return Cache::remember($cacheKey, 600, function () use ($count) {
                $testimonials = Testimonial::orderBy('created_at', 'desc')->take($count)->get();
                return View::make('Helper.testimonial_slider')->with('testimonials', $testimonials)->render();
            });
        } catch (\Exception $e) {
            Log::error("Error fetching testimonials: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}


if (!function_exists('addCommunity')) {
    function addCommunity($selected = '')
    {
        try {
            $communities = Cache::remember('all_communities_list', 3600, function () {
                return Community::all();
            });

            return View::make('Helper.communityDropdown')->with([
                'communities' => $communities,
                'selected' => $selected
            ])->render();
        } catch (\Exception $e) {
            Log::error("Error fetching communities: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}


if (!function_exists('addMetaTag')) {
    function addMetaTag($meta_title = "", $meta_description = "")
    {
        try {
            return View::make('Helper.addMetaTag')->with(['meta_title' => $meta_title, 'meta_description' => $meta_description])->render();
        } catch (\Exception $e) {
            Log::error("Error adding meta tags: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}

if (!function_exists('mediaSection')) {
    function mediaSection($count = 'all', $new_heading = '')
    {
        try {
            $cacheKey = 'media_section_' . $count;

            $gallery = Cache::remember($cacheKey, 3600, function () use ($count) {
                return $count === 'all'
                    ? Gallery::orderBy('id', 'desc')->get()
                    : Gallery::orderBy('id', 'desc')->take($count)->get();
            });

            return View::make('Helper.media')->with([
                'gallery' => $gallery,
                'new_heading' => $new_heading
            ])->render();
        } catch (\Exception $e) {
            Log::error("Error fetching media section: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}


if (!function_exists('reportmediaSection')) {
    function reportmediaSection($count = 'all', $new_heading = '')
    {
        try {
            $cacheKey = 'report_media_section_' . $count;

            $gallery = Cache::remember($cacheKey, 3600, function () use ($count) {
                return $count === 'all'
                    ? Gallery::orderBy('created_at', 'desc')->get()
                    : Gallery::orderBy('created_at', 'desc')->take($count)->get();
            });

            return View::make('Helper.report_media')->with([
                'gallery' => $gallery,
                'new_heading' => $new_heading
            ])->render();
        } catch (\Exception $e) {
            Log::error("Error fetching report media section: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}


if (!function_exists('teamSlider')) {
    function teamSlider($count = "all")
    {
        try {
            $cacheKey = 'team_slider_' . $count;

            $team = Cache::remember($cacheKey, 3600, function () use ($count) {
                return $count === 'all'
                    ? Agent::orderBy('created_at', 'desc')->get()
                    : Agent::orderBy('created_at', 'desc')->take($count)->get();
            });

            return View::make('Helper.team_slider')->with(['team' => $team])->render();
        } catch (\Exception $e) {
            Log::error("Error fetching team slider: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}


if (!function_exists('descriptionWithImages')) {
    function descriptionWithImages($description = "")
    {
        try {
            $descriptionWithImages = preg_replace('/!\[\]\((.*?)\)/', '<div class="thmb-img"><img src="$1" alt="Image" class="w-100" /></div>', $description);
            return $descriptionWithImages;
        } catch (\Exception $e) {
            Log::error("Error processing description with images: " . $e->getMessage());
            return $description; // Return original description on error
        }
    }
}

if (!function_exists('searchBox')) {
    function searchBox()
    {
        try {
            $cacheKey = 'search_box_data';

            $data = Cache::remember($cacheKey, 3600, function () {
                return [
                    'property_type' => PropertyType::all()->groupBy('property'),
                    'home' => HomePage::orderBy('id', 'desc')->first()
                ];
            });

            return View::make('Helper.commonSearch')->with($data)->render();
        } catch (\Exception $e) {
            Log::error("Error generating search box: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}


if (!function_exists('allPropertyType')) {
    function allPropertyType()
    {
        try {
            return Cache::remember('all_property_types_grouped', 3600, function () {
                return PropertyType::all()->groupBy('property');
            });
        } catch (\Exception $e) {
            Log::error("Error fetching all property types: " . $e->getMessage());
            return collect(); // Return empty collection on error
        }
    }
}


if (!function_exists('innerSearchBox')) {
    function innerSearchBox($searchData = [])
    {
        try {
            $old_property_type = '';
            if (!empty($searchData['property_type'])) {
                $old_property_type = $searchData['property_type'];
            }

            $property_type = Cache::remember('all_property_types_grouped', 3600, function () {
                return PropertyType::all()->groupBy('property');
            });

            return View::make('Helper.innerSearch')->with([
                'old_property_type' => $old_property_type,
                'property_type' => $property_type,
                'searchData' => $searchData
            ])->render();
        } catch (\Exception $e) {
            Log::error("Error generating inner search box: " . $e->getMessage());
            return ''; // Return empty string on error
        }
    }
}


if (!function_exists('getPropertyDeatil')) {
    function getPropertyDeatil($property_type = '', $property_id = "", $column_name = "")
    {
        try {
            if (!$property_type || !$property_id) {
                return '';
            }

            $propertyTypes = [
                'rent' => RentPropertie::class,
                'buy' => BuyPropertie::class,
                'project' => ProjectPropertie::class,
                'private' => PrivatePropertie::class,
                'international' => InternationalPropertie::class,
                'sales' => BuyPropertie::class,
                'branded' => BrandedPropertie::class,
                'invest' => InvestmentPropertie::class,
                'investment' => InvestmentPropertie::class
            ];

            if (array_key_exists($property_type, $propertyTypes)) {
                $cacheKey = "property_detail_{$property_type}_{$property_id}";
                $properties = Cache::remember($cacheKey, 3600, function () use ($propertyTypes, $property_type, $property_id) {
                    return $propertyTypes[$property_type]::find($property_id);
                });

                if ($column_name && $properties) {
                    if (
                        empty($properties->$column_name) &&
                        $column_name === "featured_image" &&
                        in_array($property_type, ['rent', 'buy'])
                    ) {
                        $bannerCacheKey = "banner_image_{$property_type}_{$property_id}";
                        $existingBanners = Cache::remember($bannerCacheKey, 3600, function () use ($property_id, $property_type) {
                            return Banners::where(['property_id' => $property_id, 'page_type' => $property_type])->first();
                        });

                        if ($existingBanners && $existingBanners->image_url) {
                            return $existingBanners->image_url;
                        }
                    }
                    return $properties->$column_name;
                }

                return $properties;
            }

            return '';
        } catch (\Exception $e) {
            Log::error("Error fetching property details: " . $e->getMessage());
            return null; // Return null on error
        }
    }
}

function getOption($optionName, $default = null)
{
    try {
        $option = Option::where('option_name', $optionName)->first();
        if ($option) {
            return unserialize($option->option_value);
        }
        return $default;
    } catch (\Exception $e) {
        Log::error("Error fetching option: " . $e->getMessage());
        return $default; // Return default on error
    }
}

function setOption($optionName, $value)
{
    try {
        $option = Option::updateOrCreate(
            ['option_name' => $optionName],
            ['option_value' => serialize($value)]
        );
        return $option;
    } catch (\Exception $e) {
        Log::error("Error setting option: " . $e->getMessage());
        return null; // Return null on error
    }
}

function deletePropertyFiles($property, $page_type)
{
    try {
        // Delete banners
        $existingBanners = Banners::where(['property_id' => $property->id, 'page_type' => $page_type])->get();
        foreach ($existingBanners as $banner) {
            if (deleteFile($banner->image_url)) {
                $banner->delete();
            }
        }

        // Delete property-related files
        $files = [
            $property->blog_background,
            $property->brochure,
            $property->floor_plan,
            $property->featured_image
        ];
        foreach ($files as $filePath) {
            if ($filePath) {
                deleteFile($filePath);
            }
        }
    } catch (\Exception $e) {
        Log::error("Error deleting property files: " . $e->getMessage());
    }
}

function deleteFile(?string $filePath): bool
{
    try {
        if ($filePath && file_exists($filePath)) {
            unlink($filePath);
            return true;
        }
    } catch (\Exception $e) {
        Log::error("Failed to delete file: {$filePath}. Error: {$e->getMessage()}");
    }
    return false;
}

if (!function_exists('getFirstBanner')) {
    function getFirstBanner($property_id, $page_type)
    {
        try {
            $cacheKey = "first_banner_{$page_type}_{$property_id}";
            
            $first_banner = Cache::remember($cacheKey, 3600, function () use ($page_type, $property_id) {
                return Banners::where(['page_type' => $page_type, 'property_id' => $property_id])->first();
            });

            if (!empty($first_banner) && !empty($first_banner->image_url)) {
                return $first_banner->image_url;
            }

            return "img/thumbnail-placeholder-gallery.png";
        } catch (\Exception $e) {
            Log::error("Error fetching first banner: " . $e->getMessage());
            return "img/thumbnail-placeholder-gallery.png"; // Fallback on error
        }
    }
}


function assets_old($path = "", $compress_percentage = 80)
{   
    // return asset($path);
    try {
        $tempFolder = "temp/";
        $tempPath = $tempFolder . $path;

        if (empty($path) || !file_exists($path)) {
            abort(404, "Invalid or missing file path.");
        }

        // Ensure temp directory exists
        $tempDir = dirname($tempPath);
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // If already processed, return it
        if (file_exists($tempPath)) {
            return asset($tempPath);
        }

        // Get MIME type
        $imageInfo = getimagesize($path);
        if (!$imageInfo) {
            return asset($path); // Return original if not an image
        }

        // Create instance of Spatie Image
        $image = Image::load($path);

        // Resize if larger than max dimensions
        $maxWidth = 800;
        $maxHeight = 800;
        if ($imageInfo[0] > $maxWidth || $imageInfo[1] > $maxHeight) {
            $image->width($maxWidth)->height($maxHeight);
        }

        // Optimize the image
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($path);

        // Save to temp folder
        $image->save($tempPath);

        return asset($tempPath);
    } catch (\Exception $e) {
        Log::error("Error processing assets: " . $e->getMessage());
        return asset($path); // Return original if an error occurs
    }
}


function assets($path = "", $maxWidth = 800, $maxHeight = 800, $compress_percentage = 80)
{
    try {
        if (empty($path) || !file_exists($path)) {
            abort(404, "Invalid or missing file path.");
        }

        // Define the dynamic subfolder based on dimensions
        $sizeFolder = "{$maxWidth}x{$maxHeight}";
        $tempFolder = "temp2/{$sizeFolder}/";
        $tempPath = $tempFolder . $path;

        // Ensure destination directory exists
        $tempDir = dirname($tempPath);
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // If already processed, return cached version
        if (file_exists($tempPath)) {
            return asset($tempPath);
        }

        // Get image metadata
        $imageInfo = getimagesize($path);
        if (!$imageInfo) {
            return asset($path); // Not an image, just return original
        }

        // Load image using Spatie
        $image = Image::load($path);

        // Resize only if it exceeds the max dimensions
        if ($imageInfo[0] > $maxWidth || $imageInfo[1] > $maxHeight) {
            $image->width($maxWidth)->height($maxHeight);
        }

        // Optimize original image before saving resized version
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($path);

        // Save the resized/optimized image to the dynamic temp folder
        $image->save($tempPath);

        return asset($tempPath);
    } catch (\Exception $e) {
        Log::error("yesvant() image processing error: " . $e->getMessage());
        return asset($path); // Fallback to original if anything fails
    }
}


function assets_wrong($path = "", $maxWidth = 800, $maxHeight = 800, $compress_percentage = 80)
{
    try {
        if (empty($path) || !file_exists($path)) {
            abort(404, "Invalid or missing file path.");
        }

        // Define the dynamic subfolder based on dimensions
        $sizeFolder = "{$maxWidth}x{$maxHeight}";
        $tempFolder = "temp4/{$sizeFolder}/";

        // Get filename and build WebP path
        $filename = pathinfo($path, PATHINFO_FILENAME) . '.webp';
        $tempPath = $tempFolder . $filename;

        // Ensure destination directory exists
        $tempDir = dirname($tempPath);
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // If already processed, return cached WebP version
        if (file_exists($tempPath)) {
            return asset($tempPath);
        }

        // Get image metadata
        $imageInfo = getimagesize($path);
        if (!$imageInfo) {
            return asset($path); // Not an image, just return original
        }

        // Optimize original image before doing anything
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($path);

        // Load and process image
        $image = Image::load($path);

        if ($imageInfo[0] > $maxWidth || $imageInfo[1] > $maxHeight) {
            $image->width($maxWidth)->height($maxHeight);
        }

        // Encode to webp and save to temp path
        $image->format(Manipulations::FORMAT_WEBP)
              ->quality($compress_percentage)
              ->save($tempPath);

        return asset($tempPath);
    } catch (\Exception $e) {
        Log::error("yesvant() image processing error: " . $e->getMessage());
        return asset($path); // Fallback to original
    }
}

