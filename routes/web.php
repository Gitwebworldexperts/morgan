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
use App\Http\Controllers\AgentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ListWithUsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\PropertyManagementController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\PageListWithUsController;
use App\Http\Controllers\CommunitiePropertieController;
use App\Http\Controllers\BrandedPropertieController;
use App\Http\Controllers\PageBrandedResidenceController;
use App\Http\Controllers\PrivateOfficeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MortgageCalculatorController;
use App\Http\Controllers\InvestmentPropertieController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\XMLController;
use App\Http\Controllers\ReportIndividualController;
use App\Http\Controllers\CareerPageController;


require base_path('routes/static.php');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::middleware(['auth'])->group(function () {
    Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::prefix('admin')->middleware('admin')->group(function () {

    Route::resource('regions', RegionController::class);
    Route::get('/upload_file', function () {
        return view('uploadFile'); 
    });
    Route::resource('posts', PostController::class);
    Route::resource('tags', TagController::class);
    Route::resource('/', AdminController::class);
    Route::resource('header_sections', HeaderSectionController::class);
    Route::resource('footer_sections', FooterSectionController::class);
    Route::resource('faq', FaqController::class);

    Route::resource('master_properties', PropertieController::class);
    Route::any('/properties/{property}/banners/{banner}', [PropertieController::class, 'bannerDestroy'])->name('banners.destroy');



    Route::resource('private_properties', PrivatePropertieController::class);

    Route::resource('investment_properties', InvestmentPropertieController::class);

    Route::resource('project_properties', ProjectPropertieController::class);
    Route::resource('rent_properties', RentPropertieController::class);
    Route::resource('properties', PropertieController::class);
    Route::resource('buy_properties', BuyPropertieController::class);    
    Route::resource('communitie_properties', CommunitiePropertieController::class);    
    Route::resource('branded_properties', BrandedPropertieController::class);    
    Route::resource('international_properties', InternationalPropertieController::class);


    Route::get('settings', [BaseController::class, 'settings'])->name('settings');

    Route::resource('property-types', PropertyTypeController::class);
    Route::get('property-type/create/{category}', [PropertyTypeController::class, 'create'])->name('property-type.create');
    Route::get('property-type/{category}', [PropertyTypeController::class, 'index'])->name('property-type.index');

    Route::resource('home', HomePageController::class);
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
    Route::get('/form_data', [ContactController::class, 'index'])->name('form_data.index');
    Route::get('/contents/privacy', [BaseController::class, 'privacy'])->name('contents.privacy');
    Route::get('/privacy/list', [BaseController::class, 'PrivacyList'])->name('privacy.list');
    Route::post('/store/privacy', [BaseController::class, 'PrivacyStore'])->name('store.privacy');

    Route::any('/privacy/delete/{post}', [BaseController::class, 'PrivacyDestroy'])->name('privacy.destroy');
    Route::get('/contents/edit/{post}', [BaseController::class, 'EditPrivacyPolicy'])->name('edit.policy');
    Route::any('/contents/update/{post}', [BaseController::class, 'UpdatePrivacyPolicy'])->name('update.policy');
    Route::resource('community', CommunityController::class);
    Route::resource('agents', AgentController::class);
    Route::resource('listing', ListingController::class);

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');    
    Route::resource('testimonials', TestimonialController::class); 
    Route::resource('gallery', GalleryController::class);
    
    Route::resource('page_branded_residence', PageBrandedResidenceController::class);
    
    
    Route::resource('about', AboutPageController::class)->only(['index', 'store', 'update']);
    Route::post('about/{aboutPage}/section', [AboutPageController::class, 'storeSection'])->name('about.storeSection');
    Route::delete('about/sections/{section}', [AboutPageController::class, 'destroySection'])->name('about.destroySection');

    Route::any('/ck_upload', [AdminController::class, 'ckUpload'])->name('ck.upload');

    Route::resource('property_management', PropertyManagementController::class);
    Route::resource('careers', CareerController::class);
    Route::resource('sections', PageListWithUsController::class);
    Route::resource('private_offices', PrivateOfficeController::class);
    Route::resource('communities', CommunityController::class);
    Route::get('/report', [ReportController::class, 'index'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/xml_data', [XMLController::class, 'getXml'])->name('xml');
    Route::resource('report_inidividual', ReportIndividualController::class);

    Route::get('/career-page', [CareerPageController::class, 'edit'])->name('career.edit');
    Route::any('/career-page-update', [CareerPageController::class, 'update'])->name('career.update');
    // Route::post('/career-page/delete-image', [CareerPageController::class, 'deleteImage'])->name('career.deleteImage');

    Route::post('/career-page/delete-image', [CareerPageController::class, 'deleteImage'])->name('career.deleteImage');


});


Route::prefix('files')->group(function () {
    Route::post('/upload', [FileController::class, 'create']);
    Route::get('/', [FileController::class, 'index']);
    Route::put('/{id}', [FileController::class, 'update']);
    Route::delete('/{id}', [FileController::class, 'destroy']);
});

Route::any('/search', [SearchController::class, 'search'])->name('search');

Route::post('/common_search', [SearchController::class, 'CommonSearch'])->name('common.search');

Route::get('/properties/view/{slug}', [PropertieController::class, 'DetailPage'])->name('detail.page');

Route::get('privatelisting/lists', [PropertieController::class, 'PrivateListing'])->name('private.listing');

Route::get('development/lists', [PropertieController::class,    'DevelopmentListing'])->name('devlopment.listing');

Route::get('branded_residences', [PropertieController::class, 'BrandedResidences'])->name('branded_residences');


Route::get('private_offices', [PropertieController::class, 'PrivateOffices'])->name('private_offices');


Route::get('/development/view/{slug}', [PropertieController::class, 'DevlopmentDetailPage'])->name('devlopment.detail_page');
Route::get('/privatelisting/view/{slug}', [PropertieController::class, 'PrivateDetailPage'])->name('private.detail_page');

Route::get('/investment/view/{slug}', [PropertieController::class, 'InvestmentDetailPage'])->name('investment.detail_page');



Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/contactus', [BaseController::class, 'contactus'])->name('contactus');
Route::get('/communities-detail', [BaseController::class, 'communitiesDetail'])->name('communitiesDetail');

Route::get('/contents/view/{slug}', [BaseController::class, 'PrivacyPolicy'])->name('privacy.policy');
Route::get('/contents/lists/about-us', [BaseController::class, 'AboutUs'])->name('aboutUs');
Route::get('/blogs/lists', [BaseController::class, 'BlogList'])->name('blogList');
Route::get('/blogs/view/{slug}', [BaseController::class, 'BlogSingle'])->name('blog');

Route::get('/property_management', [BaseController::class, 'PropertyManagement'])->name('property_management');


    

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/submit', [FormController::class, 'submit'])->name('intrest.submit');
Route::post('/submit-application', [ApplicationController::class, 'store'])->name('application.store');
Route::post('/list-with-us', [ListWithUsController::class, 'store'])->name('list-with-us.store');

Route::get('/career/{id}', [BaseController::class, 'Careers'])->name('detail.career');
Route::get('/careers/apply', [BaseController::class, 'CareerList'])->name('career.list');
Route::get('/applied/{id}', [CareerController::class, 'AppliedJob'])->name('applied.job');
Route::get('privatelisting/lists', [PropertieController::class, 'PrivateListing'])->name('private.listing');

Route::get('communities', [PropertieController::class, 'Communities'])->name('communities.listing');
Route::get('/list-with-us', [PageListWithUsController::class, 'Frontend'])->name('page_list_with_us');


Route::get('/communitie/{id}', [PropertieController::class, 'CommunitieDetail'])->name('detail.communitie');

Route::get('/reports', [PropertieController::class, 'ReportList'])->name('report.list');




Route::get('/mor', function () {
    return view('instant_property_valuation'); 
});

Route::get('/404', function () {
    return view('errors/404'); 
});

 Route::get('/report/{slug}', [ReportIndividualController::class, 'show'])->name('report_inidividual.show');

Route::post('/submit-career', [CareerController::class, 'submit'])->name('career.submit');


Route::get('/mortgage-calculator', [MortgageCalculatorController::class, 'index']);

Route::post('/mortgage-form', [MortgageCalculatorController::class, 'submitForm'])->name('mortgage.submit');
// Route::get('/mortgage-calculator', function () {
//     return view('mortgage_calculator'); 
// });



Route::get('/instant_property_valuation', function () {
    return view('instant_property_valuation'); 
});

Route::get('/thank-you', function () {
    return view('thanks'); 
})->name('thank-you');


Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store')->middleware('auth');
Route::get('/wishlist_page', [WishlistController::class, 'index'])->name('wishlist.index')->middleware('auth');
