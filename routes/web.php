<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\IconsController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ExComponentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ExtensionsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Affiliate\AffiliateDashboardController;
use App\Http\Controllers\Affiliate\MyProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//frontend routes
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::group(['prefix' => 'about'], function () {
    Route::get('about-us', [AboutController::class, 'aboutUs'])->name('about-index');
    Route::get('founder-info', [AboutController::class, 'founderInfo'])->name('founder-info');
    Route::get('legal-document', [AboutController::class, 'legalDocument'])->name('legal-document');
    Route::get('terms-and-condition', [AboutController::class, 'termsAndCondition'])->name('terms-and-condition');
    Route::get('our-policy', [AboutController::class, 'ourPolicy'])->name('our-policy');
    Route::get('more-service', [AboutController::class, 'moreService'])->name('more-service');
});


Route::group(['prefix' => 'login'], function () {
    Route::get('student-login', [LoginController::class, 'studentLogin'])->name('student-login');
    Route::get('founder-info', [AboutController::class, 'founderInfo'])->name('founder-info');
    Route::get('legal-document', [AboutController::class, 'legalDocument'])->name('legal-document');
    Route::get('terms-and-condition', [AboutController::class, 'termsAndCondition'])->name('terms-and-condition');
    Route::get('our-policy', [AboutController::class, 'ourPolicy'])->name('our-policy');
    Route::get('more-service', [AboutController::class, 'moreService'])->name('more-service');
});


Auth::routes(['verify' => true]);
Route::group(['prefix' => 'dashboard','middleware' => 'prevent-back-history'], function () {
    Route::get('admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard')->middleware('is_admin');
    Route::get('affiliates-dashboard', [AffiliateDashboardController::class, 'index'])->name('affiliates-dashboard')->middleware('is_affiliate');
    // Route::get('affiliates-dashboard', [AffiliateDashboardController::class, 'index'])->name('student-dashboard')->middleware('is_student');
    Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
});

// form elements

Route::group(['prefix' => 'affiliate'], function () {
    Route::get('profile', [MyProfileController::class, 'affiliateProfile'])->name('affiliate-profile');
    Route::post('getCityName', [MyProfileController::class, 'getCityByStateName'])->name('getCityName');
    Route::put('submitProfile/{id}', [MyProfileController::class, 'submitAffiliateProfile'])->name('submit-affiliate-profile');
});

// dashboard Routes
// Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');
// Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');

/* Route::group(['prefix' => 'dashboard'], function () {
    Route::get('ecommerce', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
    Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
}); */

//Application Routes
Route::group(['prefix' => 'app'], function () {
    Route::get('email', [ApplicationController::class, 'emailApplication'])->name('app-email');
    Route::get('chat', [ApplicationController::class, 'chatApplication'])->name('app-chat');
    Route::get('todo', [ApplicationController::class, 'todoApplication'])->name('app-todo');
    Route::get('calendar', [ApplicationController::class, 'calendarApplication'])->name('app-calendar');
    Route::get('kanban', [ApplicationController::class, 'kanbanApplication'])->name('app-kanban');
    Route::get('invoice/view', [ApplicationController::class, 'invoiceApplication'])->name('app-invoice-view');
    Route::get('invoice/list', [ApplicationController::class, 'invoiceListApplication'])->name('app-invoice-list');
    Route::get('invoice/edit', [ApplicationController::class, 'invoiceEditApplication'])->name('app-invoice-edit');
    Route::get('invoice/add', [ApplicationController::class, 'invoiceAddApplication'])->name('app-invoice-add');
    Route::get('file-manager', [ApplicationController::class, 'fileManagerApplication'])->name('app-file-manager');
    // User Route
    Route::get('users/list', [UsersController::class, 'listUser'])->name('app-users-list');
    Route::get('users/view', [UsersController::class, 'viewUser'])->name('app-users-view');
    Route::get('users/edit', [UsersController::class, 'editUser'])->name('app-users-edit');
});

// Content Page Routes
Route::group(['prefix' => 'content'], function () {
    Route::get('grid', [ContentController::class, 'gridContent'])->name('content-grid');
    Route::get('typography', [ContentController::class, 'typographyContent'])->name('content-typography');
    Route::get('text-utilities', [ContentController::class, 'textUtilitiesContent'])->name('content-text-utilities');
    Route::get('syntax-highlighter', [ContentController::class, 'contentSyntaxHighlighter'])->name('content-syntax-highlighter');
    Route::get('helper-classes', [ContentController::class, 'contentHelperClasses'])->name('content-helper-classes');
    Route::get('colors', [ContentController::class, 'colorContent'])->name('content-colors');
});

// icons
Route::group(['prefix' => 'icons'], function () {
    Route::get('livicons', [IconsController::class, 'liveIcons'])->name('icons-livicons');
    Route::get('boxicons', [IconsController::class, 'boxIcons'])->name('icons-boxicons');
});

// card
Route::group(['prefix' => 'card'], function () {
    Route::get('basic', [CardController::class, 'basicCard'])->name('card-basic');
    Route::get('actions', [CardController::class, 'actionCard'])->name('card-actions');
    Route::get('widgets', [CardController::class, 'widgets'])->name('card-widgets');
});


// component route
Route::group(['prefix' => 'component'], function () {
    Route::get('alerts', [ComponentController::class, 'alertComponenet'])->name('component-alerts');
    Route::get('buttons-basic', [ComponentController::class, 'buttonComponenet'])->name('component-buttons-basic');
    Route::get('breadcrumbs', [ComponentController::class, 'breadcrumbsComponenet'])->name('component-breadcrumbs');
    Route::get('carousel', [ComponentController::class, 'carouselComponenet'])->name('component-carousel');
    Route::get('collapse', [ComponentController::class, 'collapseComponenet'])->name('component-collapse');
    Route::get('dropdowns', [ComponentController::class, 'dropdownComponenet'])->name('component-dropdowns');
    Route::get('list-group', [ComponentController::class, 'listGroupComponenet'])->name('component-list-group');
    Route::get('modals', [ComponentController::class, 'modalComponenet'])->name('component-modals');
    Route::get('pagination', [ComponentController::class, 'paginationComponenet'])->name('component-pagination');
    Route::get('navbar', [ComponentController::class, 'navbarComponenet'])->name('component-navbar');
    Route::get('tabs-component', [ComponentController::class, 'tabsComponenet'])->name('component-tabs-component');
    Route::get('pills-component', [ComponentController::class, 'pillComponenet'])->name('component-pills-component');
    Route::get('tooltips', [ComponentController::class, 'tooltipsComponenet'])->name('component-tooltips');
    Route::get('popovers', [ComponentController::class, 'popoversComponenet'])->name('component-popovers');
    Route::get('badges', [ComponentController::class, 'badgesComponenet'])->name('component-badges');
    Route::get('pill-badges', [ComponentController::class, 'pillBadgesComponenet'])->name('component-pill-badges');
    Route::get('progress', [ComponentController::class, 'progressComponenet'])->name('component-progress');
    Route::get('media-objects', [ComponentController::class, 'mediaObjectComponenet'])->name('component-media-objects');
    Route::get('spinner', [ComponentController::class, 'spinnerComponenet'])->name('component-spinner');
    Route::get('bs-toast', [ComponentController::class, 'toastsComponenet'])->name('component-bs-toast');
});

// extra component
Route::group(['prefix' => 'extra-component'], function () {
    Route::get('avatar', [ExComponentController::class, 'avatarComponent'])->name('extra-component-avatar');
    Route::get('chips', [ExComponentController::class, 'chipsComponent'])->name('extra-component-chips');
    Route::get('divider', [ExComponentController::class, 'dividerComponent'])->name('extra-component-divider');
});

// form elements
Route::group(['prefix' => 'form'], function () {
    Route::get('inputs', [FormController::class, 'inputForm'])->name('form-inputs');
    Route::get('input-groups', [FormController::class, 'inputGroupForm'])->name('form-input-groups');
    Route::get('number-input', [FormController::class, 'numberInputForm'])->name('form-number-input');
    Route::get('select', [FormController::class, 'selectForm'])->name('form-select');
    Route::get('radio', [FormController::class, 'radioForm'])->name('form-radio');
    Route::get('checkbox', [FormController::class, 'checkboxForm'])->name('form-checkbox');
    Route::get('switch', [FormController::class, 'switchForm'])->name('form-switch');
    Route::get('textarea', [FormController::class, 'textareaForm'])->name('form-textarea');
    Route::get('quill-editor', [FormController::class, 'quillEditorForm'])->name('form-quill-editor');
    Route::get('file-uploader', [FormController::class, 'fileUploaderForm'])->name('form-file-uploader');
    Route::get('date-time-picker', [FormController::class, 'datePickerForm'])->name('form-date-time-picker');
    Route::get('layout', [FormController::class, 'formLayout'])->name('form-layout');
    Route::get('wizard', [FormController::class, 'formWizard'])->name('form-wizard');
    Route::get('validation', [FormController::class, 'formValidation'])->name('form-validation');
    Route::get('repeater', [FormController::class, 'formRepeater'])->name('form-repeater');
});

// table route
Route::group(['prefix' => 'table'], function () {
    Route::get('', [TableController::class, 'basicTable'])->name('table');
    Route::get('extended', [TableController::class, 'extendedTable'])->name('table-extended');
    Route::get('datatable', [TableController::class, 'dataTable'])->name('table-datatable');
});

// page Route
Route::group(['prefix' => 'page'], function () {
    Route::get('user/profile', [PageController::class, 'userProfilePage'])->name('page-user-profile');
    Route::get('faq', [PageController::class, 'faqPage'])->name('page-faq');
    Route::get('knowledge-base', [PageController::class, 'knowledgeBasePage'])->name('page-knowledge-base');
    Route::get('knowledge-base/categories', [PageController::class, 'knowledgeCatPage'])->name('page-knowledge-base');
    Route::get('knowledge-base/categories/question', [PageController::class, 'knowledgeQuestionPage'])->name('page-knowledge-base');
    Route::get('search', [PageController::class, 'searchPage'])->name('page-search');
    Route::get('account-settings', [PageController::class, 'accountSettingPage'])->name('page-account-settings');
});

// Authentication  Route
Route::group(['prefix' => 'auth'], function () {
    Route::get('student-login', [AuthenticationController::class, 'studentLogin'])->name('student-login');
    Route::get('affiliates-login', [AuthenticationController::class, 'affiliatesLogin'])->name('affiliates-login');
    Route::get('admin-login', [AuthenticationController::class, 'adminLogin'])->name('admin-login');
    Route::post('login-verfication', [AuthenticationController::class, 'loginVerfication'])->name('login-verfication');
    Route::get('affiliate_register', [AuthenticationController::class, 'affiliatesRegister'])->name('affiliates-register');

    Route::post('signup-verfication', [AuthenticationController::class, 'signupVerfication'])->name('signup-verfication');
    Route::get('signout', [AuthenticationController::class,'signout'])->name('signout');

    // Route::get('login', [AuthenticationController::class, 'loginPage'])->name('auth-login');
    Route::get('register', [AuthenticationController::class, 'registerPage'])->name('auth-register');
    Route::get('forgot-password', [AuthenticationController::class, 'forgetPasswordPage'])->name('auth-forgot-password');
    Route::get('reset-password', [AuthenticationController::class, 'resetPasswordPage'])->name('auth-reset-password');
    Route::get('lock-screen', [AuthenticationController::class, 'authLockPage'])->name('auth-lock-screen');
});

// Miscellaneous
Route::group(['prefix' => 'misc'], function () {
    Route::get('coming-soon', [MiscellaneousController::class, 'comingSoonPage'])->name('misc-coming-soon');
    Route::get('error-404', [MiscellaneousController::class, 'error404Page'])->name('misc-error-404');
    Route::get('error-500', [MiscellaneousController::class, 'error500Page'])->name('misc-error-500');
    Route::get('not-authorized', [MiscellaneousController::class, 'notAuthPage'])->name('misc-not-authorized');
    Route::get('maintenance', [MiscellaneousController::class, 'maintenancePage'])->name('misc-maintenance');
});

// Charts Route
Route::group(['prefix' => 'chart'], function () {
    Route::get('apex', [ChartController::class, 'apexChart'])->name('chart-apex');
    Route::get('chartjs', [ChartController::class, 'chartJs'])->name('chart-chartjs');
    Route::get('chartist', [ChartController::class, 'chartist'])->name('chart-chartist');
});

Route::get('maps/leaflet', [ChartController::class, 'leafletMap'])->name('maps-leaflet');

// extension route
Route::group(['prefix' => 'extension'], function () {
    Route::get('sweet-alerts', [ExtensionsController::class, 'sweetAlert'])->name('extension-sweet-alerts');
    Route::get('toastr', [ExtensionsController::class, 'toastr'])->name('extension-toastr');
    Route::get('noui-slider', [ExtensionsController::class, 'noUiSlider'])->name('extension-noui-slider');
    Route::get('drag-drop', [ExtensionsController::class, 'dragComponent'])->name('extension-drag-drop');
    Route::get('tour', [ExtensionsController::class, 'tourComponent'])->name('extension-tour');
    Route::get('swiper', [ExtensionsController::class, 'swiperComponent'])->name('extension-swiper');
    Route::get('treeview', [ExtensionsController::class, 'treeviewComponent'])->name('extension-treeview');
    Route::get('block-ui', [ExtensionsController::class, 'blockUIComponent'])->name('extension-block-ui');
    Route::get('media-player', [ExtensionsController::class, 'mediaComponent'])->name('extension-media-player');
    Route::get('miscellaneous', [ExtensionsController::class, 'miscellaneous'])->name('extension-miscellaneous');
    Route::get('locale', [ExtensionsController::class, 'locale'])->name('extension-locale');
    Route::get('ratings', [ExtensionsController::class, 'ratings'])->name('extension-ratings');
});

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('lang-locale');
