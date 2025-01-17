<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('billing', function () {
        return view('billing');
    })->name('billing');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');



    Route::get('tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('virtual-reality', function () {
        return view('virtual-reality');
    })->name('virtual-reality');

    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');

    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');



    Route::get('customers', [CustomerController::class, 'index']);
    Route::get('customers/create', [CustomerController::class, 'create']);
    Route::post('customers/store', [CustomerController::class, 'store']);
    Route::get('get-data', [AjaxController::class, 'getData']);
    Route::get('get_customer_details', [AjaxController::class, 'get_customer_details']);
    Route::get('check_customer_number/{cell}', [AjaxController::class, 'check_customer_number']);
    Route::get('customer_list/{query?}', [AjaxController::class, 'customer_search']);
    Route::get('customers/destroy/{id}', [CustomerController::class, 'destroy']);
    Route::get('customers/edit/{id}', [CustomerController::class, 'edit']);
    Route::get('customers/view/{id}', [CustomerController::class, 'view']);
    Route::get('customers/update/{id}', [CustomerController::class, 'update']);
    Route::get('get_customer_data', 'AjaxController@getCustomerData')->name('get_customer_data');


    // Inquiry Types
    Route::get('/inquiry', [InquiryController::class, 'get_inquiry_list']);
    Route::get('/get_followup_details/{id}', [AjaxController::class, 'get_followup_details']);
    Route::get('/inquiry_edit/{inquiry_id}', [InquiryController::class, 'edit_inquiry_index']);
    Route::get('/inquiry_ajax_list', [InquiryController::class, 'getdata']);
    Route::get('/inquiry/create', [InquiryController::class, 'create']);
    Route::get('/inquiry_test/create', [InquiryController::class, 'create_test']);
    Route::post('/inquiry/store', [InquiryController::class, 'store']);
    Route::post('/add_inquiry_remarks', [InquiryController::class, 'add_inquiry_remarks']);
    Route::post('/add_followup_remarks', [InquiryController::class, 'add_followup_remarks']);
    Route::post('/inquiry_edit_update', [InquiryController::class, 'inquiry_edit_update']);
    Route::get('/append_services_edit/{inq_id}', [InquiryController::class, 'append_services_edit']);
    Route::get('/edit_inquiry/{id}', [InquiryController::class, 'edit'])->name('edit_inquiry');
    Route::post('/update_inquiry/{id}', [InquiryController::class, 'update'])->name('update_inquiry');
    Route::get('/delete_inquiry/{id}', [InquiryController::class, 'destroy'])->name('delete_inquiry');
    Route::get('/get_sub_services/{id}', [AjaxController::class, 'get_sub_services'])->name('get_sub_services');
    Route::get('/get_sub_services_id/{id}/{inq_id}', [AjaxController::class, 'get_sub_services_id']);
    Route::get('/add_more_services/{count}', [AjaxController::class, 'add_more_services'])->name('add_more_services');
    Route::get('/add_more_services_users/{count}', [AjaxController::class, 'add_more_services_users'])->name('add_more_services_users');
    Route::get('/get_campaign_data/{id}', [AjaxController::class, 'get_campaign_data'])->name('get_campaign_data');
    Route::get('/follow_up/{id}', [InquiryController::class, 'follow_up']);

    Route::get('/create_quotation/{id}', [QuotationController::class, 'create_quotation']);
    Route::get('autocomplete_country', [AjaxController::class, 'autocomplete'])->name('autocomplete_country');
    Route::get('autocomplete_city', [AjaxController::class, 'autocomplete_city'])->name('autocomplete_city');

    // Route::get('user-management', function () {
    //     return view('laravel-examples/user-management');
    // })->name('user-management');
    Route::get('user-management', [UsersController::class, 'index']);
    Route::get('users/create', [UsersController::class, 'create']);
    Route::post('users/store', [UsersController::class, 'store']);
    Route::get('users/edit/{id}', [UsersController::class, 'edit']);
    Route::post('users/update/{id}', [UsersController::class, 'update']);
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});


Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
