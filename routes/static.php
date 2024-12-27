<?php

use Illuminate\Support\Facades\Route;

Route::get('/properties-for-sale-dubai', function () {
    return view('static.properties-for-sale-dubai');
})->name('properties-for-sale-dubai');

Route::get('/beach-front-villas-for-rent-dubai', function () {
    return view('static.beach-front-villas-for-rent-dubai');
})->name('beach-front-villas-for-rent-dubai');

Route::get('/best-real-estate-dubai', function () {
    return view('static.best-real-estate-dubai');
})->name('best-real-estate-dubai');

Route::get('/bluewaters-apartments-dubai', function () {
    return view('static.bluewaters-apartments-dubai');
})->name('bluewaters-apartments-dubai');

Route::get('/blue-water-island-residences-dubai', function () {
    return view('static.blue-water-island-residences-dubai');
})->name('blue-water-island-residences-dubai');

Route::get('/commercial-land-for-sale-dubai', function () {
    return view('static.commercial-land-for-sale-dubai');
})->name('commercial-land-for-sale-dubai');

// Route::get('/privatelisting/view/district-one-mohammed-bin-rashid-city-villas', function () {
//     return view('static.district-one-mohammed-bin-rashid-city-villas');
// })->name('privatelisting/view/district-one-mohammed-bin-rashid-city-villas');

Route::get('/dubai-real-estate-for-sale', function () {
    return view('static.dubai-real-estate-for-sale');
})->name('dubai-real-estate-for-sale');

// Route::get('/privatelisting/view/mansion-in-emirates-hills', function () {
//     return view('static.mansion-in-emirates-hills');
// })->name('privatelisting/view/mansion-in-emirates-hills');

// Route::get('/privatelisting/view/emirates-hills-villas', function () {
//     return view('static.emirates-hills-villas');
// })->name('privatelisting/view/emirates-hills-villas');

Route::get('/freehold-land-dubai', function () {
    return view('static.freehold-land-dubai');
})->name('freehold-land-dubai');

Route::get('/jumeirah-beach-residence-dubai', function () {
    return view('static.jumeirah-beach-residence-dubai');
})->name('jumeirah-beach-residence-dubai');

Route::get('/jumeirah-bay-island-villas', function () {
    return view('static.jumeirah-bay-island-villas');
})->name('jumeirah-bay-island-villas');

// Route::get('investment.detail_page','building-for-sale-jumeirah-golf-estates', function () {
//     return view('static.building-for-sale-jumeirah-golf-estates');
// })->name('investment/view/building-for-sale-jumeirah-golf-estates');

Route::get('/apartments-for-sale-dubai', function () {
    return view('static.apartments-for-sale-dubai');
})->name('apartments-for-sale-dubai');

Route::get('/beach-house-properties-for-sale-dubai', function () {
    return view('static.beach-house-properties-for-sale-dubai');
})->name('beach-house-properties-for-sale-dubai');

Route::get('/villa-for-sale-dubai', function () {
    return view('static.villa-for-sale-dubai');
})->name('villa-for-sale-dubai');

Route::get('/land-for-rent-dubai', function () {
    return view('static.land-for-rent-dubai');
})->name('land-for-rent-dubai');

Route::get('/land-for-sale-palm-jumeirah-dubai', function () {
    return view('static.land-for-sale-palm-jumeirah-dubai');
})->name('land-for-sale-palm-jumeirah-dubai');

Route::get('/land-for-sale-dubai-hills', function () {
    return view('static.land-for-sale-dubai-hills');
})->name('land-for-sale-dubai-hills');

// Route::get('investment.detail_page','rare-residential-plot-for-sale-in-dubai-marina', function () {
//     return view('static.rare-residential-plot-for-sale-in-dubai-marina');
// })->name('investment/view/rare-residential-plot-for-sale-in-dubai-marina');

Route::get('/dubai-land-damac-hills', function () {
    return view('static.dubai-land-damac-hills');
})->name('dubai-land-damac-hills');

Route::get('/land-for-sale-dubai-industrial-city', function () {
    return view('static.land-for-sale-dubai-industrial-city');
})->name('land-for-sale-dubai-industrial-city');

Route::get('/palm-jumeirah-mansions', function () {
    return view('static.palm-jumeirah-mansions');
})->name('palm-jumeirah-mansions');

Route::get('/penthouses-for-sale-dubai', function () {
    return view('static.penthouses-for-sale-dubai');
})->name('penthouses-for-sale-dubai');

Route::get('/villas-for-sale-jumeirah-bay-island', function () {
    return view('static.villas-for-sale-jumeirah-bay-island');
})->name('villas-for-sale-jumeirah-bay-island');

Route::get('/property-for-sale-dubai', function () {
    return view('static.property-for-sale-dubai');
})->name('property-for-sale-dubai');

Route::get('/property-downtown-dubai', function () {
    return view('static.property-downtown-dubai');
})->name('property-downtown-dubai');

Route::get('/real-estate-agents-dubai', function () {
    return view('static.real-estate-agents-dubai');
})->name('real-estate-agents-dubai');

Route::get('/villas-downtown-dubai', function () {
    return view('static.villas-downtown-dubai');
})->name('villas-downtown-dubai');

$site_settings = [
'villas-downtown-dubai' => ["Commercial Land for Sale Dubai, Plots, Buildings – Morgan’s International Realty","Commercial land for sale in Dubai available with Morgan’s International Realty. To explore more on commercial plots/properties for sale in UAE, browse the website now."],
'villa-for-sale-dubai' => ["Luxury Villas for Sale in Dubai Land, Luxury Homes, Mansions for sale in Dubai", "Buy Luxury Villas, Homes, and Mansions for sale in Dubai with Morgan’s International Realty. Here you can find thousands of Luxury Homes, Mansions, and Villas for sale in Dubai at attractive prices."],
'apartments-for-sale-dubai' => ["Luxury Apartments for Sale in Dubai, Buy apartments in Dubai – Morgan’s International Realty","Luxury apartments for sale in Dubai. Morgan’s International Realty helps you to search the wide range of Apartments for sale in Dubai. Get Verified apartments ✓ Brand New✓ Furnished Options✓ Ready to Move✓ with Easy Payment Plans."],
'best-real-estate-dubai' => ["Best Real Estate Agency in Dubai for Property Sales & Rents – Morgan’s International","Morgan’s International Realty is one of the most well-known real estate companies/agencies. We offer the best real estate Properties for sale and Properties for Rent with all the amenities you need at attractive prices. To get more details on luxury properties, visit the website now."],
'freehold-land-dubai' => ["Freehold Land in Dubai, Commercial, Residential, and Industrial Properties in Dubai","Searching for a freehold land in Dubai? If yes, there are a number of freehold property options you will get with Morgan’s International Realty Dubai - the best platform for buying Commercial, Residential, and Industrial freehold Properties in Dubai."],
'land-for-rent-dubai' => ["Land for Rent/Lease Dubai, Plots for Rent UAE  - Morgan’s International Realty","Looking for land for rent/lease in Dubai? If yes, then contact Morgan’s International Realty. We will help you buy land for lease/rent across UAE at the best prices. To explore more on rental properties, visit the website now."],
'villas-for-sale-jumeirah-bay-island' => ["Mansions, Villas, Properties, Beach House, for Sale Jumeirah Bay – Morgan’s International Realty","Beach houses, mansions, villas and properties are available for sale in Jumeirah Bay at Morgan’s International Realty. We help you buy properties in UAE at attractive prices. For more details, contact us now."],
'jumeirah-bay-island-villas' => ["Jumeirah Bay Island Villas for Sale, Properties, Mansions – Morgan’s International Realty","When it comes to finding the best Jumeirah Bay Island villas, properties, and mansions for sale, Morgan’s International Realty is the perfect place. Here you can buy properties across UAE at the best prices. For more information, visit the website now."],
'jumeirah-beach-residence-dubai' => ["Jumeirah Beach Residence Dubai, Apartments for Sale – Morgan’s International Realty","Looking to buy property in Jumeirah beach residence in Dubai? If yes, then visit Morgan’s International Realty. Our experts will help you find and buy a property in JBR, located in the most coveted seafront district of Dubai Marina."],
'building-for-sale-jumeirah-golf-estates' => ["Jumeirah Golf Estates Villas for Sale, Luxury homes with First Class Amenities","Jumeirah Golf Estates is a world-class golf destination offering Villas and luxury homes for sale with Leisure Facilities. You have no need to go anywhere as we offer high-end finished properties/villas with unmatched lifestyles in Jumeirah Golf Estates."],
'atlantis-the-royal-residences' => ["Atlantis The Royal Residences, Palm Jumeirah, Dubai","Atlantis The Royal Residences is one of the most premium residential & and hotel property development located at Palm Jumeirah, Dubai. Connect with Morgan’s International Realty to buy and sell Apartments in Atlantis with modern guest rooms, suites, sophisticated design, and endless horizons."],
'palm-jumeirah-mansions' => ["Palm Jumeirah Mansions for Sale Dubai, UAE – Morgan’s International Realty","Interested in buying mansions or villas in Palm Jumeirah? If yes, then you have no need to worry. Morgan’s International Realty experts can help you buy luxury property at the best prices. For more details, contact us now."],
'land-for-sale-palm-jumeirah-dubai' => ["Land for Sale, Palm Jumeirah Dubai, Buy Plot – Morgan’s International Realty","Discover land/residential plots for sale in Palm Jumeirah Dubai with Morgan’s International Realty at attractive prices. We are a well-reputed real estate brokerage firm in Dubai to help you buy land or residential plots as per your requirement."],
'beach-house-properties-for-sale-dubai' => ["Beachfront Villas for Sale in Dubai, Luxury beachfront Homes for sale in Dubai","If you are looking for luxury beachfront homes for sale in Dubai. To discover your dream properties like beachfront homes, modern houses, villas, apartments & and penthouses, visit Morgan’s International Realty. Contact us today to get more details."],
'properties-for-sale-dubai' => ["Beachfront Properties for Sale in Dubai – Morgan’s International Realty","Beachfront properties for sale in Dubai- Contact Morgan’s International Realty to get beachfront apartments & and villas in Dubai with breathtaking sea views and white sands."],
'beach-front-villas-for-rent-dubai' => ["Beach Front Villas for Rent Dubai, UAE – Morgan’s International Realty","Want to buy beach front villas for rent in Dubai? Complete your search at Morgan’s International Realty, one of the best real estate brokerage firms offering beach-front properties at best prices."],
'property-downtown-dubai' => ["Property in Downtown Dubai, Buy Properties UAE – Morgan’s International Realty","Planning to buy property in Downtown Dubai? You are in the right place. Morgan’s International Realty is a well-reputed real estate brokerage firm that offers various types of properties for sale in Dubai"],
'villas-downtown-dubai' => ["Villas/Houses for Sale Downtown Dubai – Morgan’s International Realty","Villas/houses for sale are available in Downtown Dubai at Morgan’s International Realty. Complete your search here and contact us to buy a villa/house as per your requirement. We are here to assist you."],
'land-for-sale-dubai-hills' => ["Land for Sale Dubai Hills, UAE – Morgan’s International Realty","If you are looking for land for sale in Dubai Hills, then you must visit Morgan’s International Realty. Our property investment consultants can help you buy land in Dubai Hills at the best prices. For more information, contact us now. "],
'dubai-land-damac-hills' => ["Dubai Land for Sale, Damac Hills, Buy Plot – Morgan’s International Realty","Want to buy land in Dubai, Damac Hills? If yes, then contact Morgan’s International Realty, a real estate brokerage firm and property investment consultant, dedicated to helping you buy land in Damac Hills at best price."],
'land-for-sale-dubai-industrial-city' => ["Land for Sale Dubai Industrial City, Buy Plot – Morgan’s International Realty","Discover land for sale in Dubai industrial city with Morgan’s International Realty. We are a well-reputed real estate brokerage firm in Dubai to help you buy land in Dubai industrial city at best prices. For more details, contact us now."],
'bluewaters-apartments-dubai' => ["Apartments for Sale/Rent, Bluewaters Dubai, Flats – Morgan’s International Realty","Searching for apartments for sale/rent in Bluewaters Dubai, a vibrant lifestyle destination? If yes, then your search ends here. Morgan’s International Realty is a well-reputed real estate brokerage firm offering apartments for sale in Blue waters at attractive prices."],
'blue-water-island-residences-dubai' => ["Blue Water Island Residences Dubai – Morgan’s International Realty","Get the best deals on Blue Water, Dubai residences with Morgan’s International Realty, offering an opportunity to buy exclusive, luxury properties, apartments and flats in the Bluewaters island residences at attractive prices."],
'penthouses-for-sale-dubai' => ["Penthouses for Sale, Dubai, Buy Penthouses – Morgan’s International Realty","Penthouses in Dubai for sale are available at Morgan’s International Realty. Our consultants help you buy penthouses in Dubai at attractive prices. For more information, contact us now."],
'commercial-land-for-sale-dubai' => ["Commercial Land for Sale Dubai, Plots, Buildings – Morgan’s International Realty","Commercial land for sale in Dubai available with Morgan’s International Realty. To explore more on commercial plots/properties for sale in UAE, browse the website now."],
];


Config::set('static_meta', $site_settings);