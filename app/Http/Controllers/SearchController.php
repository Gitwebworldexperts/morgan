<?php

namespace App\Http\Controllers;

use App\Models\RentPropertie;
use App\Models\BuyPropertie;
use App\Models\ProjectPropertie;
use App\Models\PrivatePropertie;
use App\Models\InternationalPropertie;
use App\Models\PropertyType;
use App\Models\Banners;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $this->page_title = '';
        $propFor = $request->input('prop_for');
        $pagination = $request->input('page');

        // Check if pagination was requested and set propFor if needed
        if ($pagination) {
            $previousUrl = url()->previous();
            parse_str(parse_url($previousUrl, PHP_URL_QUERY), $queryParams);
            $propFor = $queryParams['prop_for'] ?? null;
        }

        // Redirect if propFor is empty
        if (empty($propFor)) {
            return redirect()->route('home');
        }

        $propertyTypes = [
            'rent' => RentPropertie::class,
            'project' => ProjectPropertie::class,
            'private' => PrivatePropertie::class,
            'international' => InternationalPropertie::class,
            'buy' => BuyPropertie::class,
        ];

        // Check if the requested property type exists
        if (array_key_exists($propFor, $propertyTypes)) {
            // Fetch properties with pagination
            $properties = $propertyTypes[$propFor]::orderBy('id', 'desc')->with('propertyType')->paginate(12); // Change to your desired items per page

            $data = [
                'page_title' => ucfirst($propFor) . " Properties",
                'page_type' => $propFor,
                'property' => $properties,
                'title' => ucfirst($propFor) . " "
            ];

            // Pass 'prop_for' through the pagination links
            $properties->appends(['prop_for' => $propFor]);

            // Return view directly with paginated data
            return view('search', compact('data'));
        } else {
            return redirect()->route('home');    
        }
    }


}
