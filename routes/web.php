<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HeaderSectionController;
use App\Http\Controllers\FooterSectionController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\PropertieController;
use App\Http\Controllers\PropertyTypeController;

use App\Http\Controllers\PrivatePropertieController;
use App\Http\Controllers\InternationalPropertieController;
use App\Http\Controllers\ProjectPropertieController;
use App\Http\Controllers\RentPropertieController;
use App\Http\Controllers\BuyPropertieController;
use App\Http\Controllers\HomePageController;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::middleware(['auth'])->group(function () {

Route::prefix('admin')->group(function () {

    Route::resource('/', AdminController::class);
    Route::resource('header_sections', HeaderSectionController::class);
    Route::resource('footer_sections', FooterSectionController::class);
    Route::resource('faq', FaqController::class);

    Route::resource('master_properties', PropertieController::class);
    Route::delete('/properties/{property}/banners/{banner}', [PropertieController::class, 'bannerDestroy'])->name('banners.destroy');


    Route::resource('private_properties', PrivatePropertieController::class);
    Route::resource('project_properties', ProjectPropertieController::class);
    Route::resource('rent_properties', RentPropertieController::class);
    Route::resource('properties', PropertieController::class);
    Route::resource('buy_properties', BuyPropertieController::class);    
    Route::resource('international_properties', InternationalPropertieController::class);


    Route::get('settings', [BaseController::class, 'settings'])->name('settings');

    Route::resource('property-types', PropertyTypeController::class);
    Route::get('property-type/create/{category}', [PropertyTypeController::class, 'create'])->name('property-type.create');
    Route::get('property-type/{category}', [PropertyTypeController::class, 'index'])->name('property-type.index');

    Route::resource('home', HomePageController::class);

});

