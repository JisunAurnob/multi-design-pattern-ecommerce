<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerAddressController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Backend\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/registration', [AuthController::class, 'registration']);

Route::post('/customer/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/customer/resend-otp', [AuthController::class, 'resendOtp']);

Route::post('/customer/forgot-password', [AuthController::class, 'forgetPassword']);
Route::post('/customer/forgot-password-post', [AuthController::class, 'postForgetPassword']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/profile', [AuthController::class, 'viewProfile']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::get('/delete-my-account', [AuthController::class, 'deleteAccount']);

    Route::post('/helpline', [AuthController::class, 'helpline']);
    Route::post('/profile/update', [AuthController::class, 'update']);
    Route::get('/logout', [AuthController::class, 'logout']);


    Route::get('/notifications', [NotificationController::class, 'notification']);
    Route::get('/count-notifications', [NotificationController::class, 'countNotification']);
    Route::get('/mark-notification/{id}', [NotificationController::class, 'markNotification']);

    //orders api
    Route::post('/order/place', [OrderController::class, 'placeOrder']);
    Route::post('/success', [SslCommerzPaymentController::class, 'success']);



    Route::get('/order/history', [OrderController::class, 'orderHistory']);
    Route::get('/order/{order_id}/view', [OrderController::class, 'viewOrder']);
    Route::get('/order/{order_id}/cancel', [OrderController::class, 'cancelOrder']);
    Route::post('/order/{order_id}/rate-review', [OrderController::class, 'rateReview']);
    Route::get('/order/track/{id}',[OrderController::class, 'orderTrack']);

    //address api
    Route::get('/address', [CustomerAddressController::class, 'allAddress']);
    Route::post('/address/create', [CustomerAddressController::class, 'createAddress']);
    Route::put('/address/{address_id}/update', [CustomerAddressController::class, 'updateAddress']);
    Route::get('/address/{address_id}', [CustomerAddressController::class, 'viewAddress']);
    Route::get('/address/{address_id}/make-default', [CustomerAddressController::class, 'makeDefaultAddress']);
    Route::get('/addresses/{address_id}/delete', [CustomerAddressController::class, 'deleteAddress']);
    Route::get('/addresses/get-default', [CustomerAddressController::class, 'getDefaultAddress']);
});


Route::get('/services', [ServiceController::class, 'list']);
Route::get('/single/{id}', [ServiceController::class, 'demoSingle']);

// need to develop by Shikha
Route::get('/services/{service_id}/products', [ServiceController::class, 'servicesWithProducts']);
Route::get('/all-services/with-all-products', [ServiceController::class, 'allServicesWithAllProducts']);
Route::get('/sliders', [HomeController::class, 'sliders']);

//business settings
Route::get('/settings', [HomeController::class, 'businessSettings']);


Route::prefix('location')->group(function () {
    Route::get('/divisions', [LocationController::class, 'division']);
    Route::get('/district/{division_id?}', [LocationController::class, 'district']);
    Route::get('/upazila/{district_id?}', [LocationController::class, 'upazilas']);
    Route::get('/union/{upazila?}', [LocationController::class, 'unions']);
    Route::get('/district_by_name/{division_name?}', [LocationController::class, 'districtByName']);
    Route::get('/upazila_by_name/{district_name?}', [LocationController::class, 'upazilasByName']);
    Route::get('/union_by_name/{upazila_name?}', [LocationController::class, 'unionsByName']);
});


