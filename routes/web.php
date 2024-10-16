<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HeaderSectionController;
use App\Http\Controllers\FooterSectionController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\PropertieController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PrivatePropertieController;
use App\Http\Controllers\InternationalPropertieController;
use App\Http\Controllers\ProjectPropertieController;
use App\Http\Controllers\RentPropertieController;
use App\Http\Controllers\BuyPropertieController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommunityController;
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::middleware(['auth'])->group(function () {
    Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::prefix('admin')->middleware('admin')->group(function () {

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
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
    Route::get('/contents/privacy', [BaseController::class, 'privacy'])->name('contents.privacy');
    Route::get('/privacy/list', [BaseController::class, 'PrivacyList'])->name('privacy.list');
    Route::post('/store/privacy', [BaseController::class, 'PrivacyStore'])->name('store.privacy');

    Route::any('/privacy/delete/{post}', [BaseController::class, 'PrivacyDestroy'])->name('privacy.destroy');
    Route::get('/contents/edit/{post}', [BaseController::class, 'EditPrivacyPolicy'])->name('edit.policy');
    Route::any('/contents/update/{post}', [BaseController::class, 'UpdatePrivacyPolicy'])->name('update.policy');
    Route::resource('community', CommunityController::class);
});

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/contactus', [BaseController::class, 'contactus'])->name('contactus');
Route::get('/communities-detail', [BaseController::class, 'communitiesDetail'])->name('communitiesDetail');


Route::get('/contents/view/{slug}', [BaseController::class, 'PrivacyPolicy'])->name('privacy.policy');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
