<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChangePassword;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ForgetPasswordController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingChargeController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SslCommerzPaymentController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WishlistController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\ResetPasswordController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Frontend\WishlistController as FrontendWishlistController;
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


// Frontend
// index

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/kids', [HomeController::class, 'list'])->name('kids.list');
Route::get('/all-products', [FrontendProductController::class, 'products'])->name('all.products');
Route::get('/address', [HomeController::class, 'address'])->name('address');
Route::get('/order', [FrontendOrderController::class, 'order'])->name('order');
Route::get('/product-details', [FrontendProductController::class, 'productDetails'])->name('products.details');


Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about.us');

//login registration
Route::get('/user/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/user/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/user/registration', [AuthController::class, 'registration'])->name('user.registration');
Route::post('/login/post', [AuthController::class, 'loginPost'])->name('user.login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::post('/user/verify/email', [AuthController::class, 'emailVerification'])->name('user.verify.email');
Route::post('/user/verify/resend-otp', [AuthController::class, 'resendOTP'])->name('user.email.resend');



//reset password

Route::get('/reset/password/form', [ResetPasswordController::class, 'passwordResetForm'])->name('user.reset.password.form');
Route::post('/reset/password/form', [ResetPasswordController::class, 'resetPasswordContact'])->name('user.reset.password.contact');
Route::get('/reset/password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('user.reset.password');
Route::post('/reset/password/post/{token}', [ResetPasswordController::class, 'resetPasswordPost'])->name('user.reset.password.post');

Route::get('/user/update/password', [ResetPasswordController::class, 'passwordUpdateForm'])->name('user.update.password.form');
Route::post('/user/update/password', [ResetPasswordController::class, 'userUpdatePassword'])->name('user.update.pasword');

// product
Route::get('/products', [FrontendProductController::class, 'products'])->name('products');
Route::get('/product/view/{slug}', [FrontendProductController::class, 'view'])->name('products.view');
Route::get('/category-wise-product/{slug}', [FrontendProductController::class, 'getProductByCategorySlug'])->name('category.wise.product');
Route::get('/search', [FrontendProductController::class, 'productSearch'])->name('search');

//cart
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('addToCart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('updateCart', [CartController::class, 'updateCart'])->name('updateCart');
Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::get('cart/destroy', [CartController::class, 'destroy'])->name('cart.destroy');


Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);


Route::group(['middleware' => ['auth:customer']], function () {

    //checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/order/place', [CheckoutController::class, 'orderPlace'])->name('checkout.process');
    Route::get('/custom/product/order/{request_id}', [CheckoutController::class, 'customeProduct'])->name('order.custom.product');

    //profile
    Route::get('profile', [FrontendUserController::class, 'profile'])->name('profile');
    Route::put('/profile/update/{id}', [FrontendUserController::class, 'profileUpdate'])->name('profile.update');
    Route::put('/update/password', [FrontendUserController::class, 'passwordUpdate'])->name('password.update');
    Route::get('order-view/{order_no}', [FrontendUserController::class, 'viewOrder'])->name('view.order');
    Route::get('/order/cancel/{order_id}', [FrontendUserController::class, 'cancelForm'])->name('order.cancel.form');
    Route::post('/order/cancel/{order_id}', [FrontendUserController::class, 'orderCancel'])->name('order.cancel');
    //track order
    Route::get('track-order/{order_no}', [FrontendUserController::class, 'trackOrder'])->name('trackOrder');

    // ratereview
    Route::get('/order/rate-review/{order_details_id}/{product_id}', [FrontendUserController::class, 'reviewRating'])->name('review.rate');
    Route::post('/order/rate-review/post/{order_details_id}/{product_id}', [FrontendUserController::class, 'reviewRatingPost'])->name('review.rate.post');


    // Product request
    // Route::post('/product/request', [ProductRequestController::class, 'productRequest'])->name('product.request');

    //wishlist
    Route::get('/add/to/wishlist/{id}', [FrontendWishlistController::class, 'addToWishlist'])->name('add.to.wishlist');
    Route::get('/wishlist/remove/{id}', [FrontendWishlistController::class, 'removewishlist'])->name('remove.product.wishlist');
    Route::get('/wishlist', [FrontendWishlistController::class, 'wishlist'])->name('wishlist');
    //contact
    Route::get('contact', [ContactController::class, 'contact'])->name('contact');
    Route::post('/contact/post', [ContactController::class, 'contactPost'])->name('contact.post');

    Route::get('/payment/success', [FrontendOrderController::class, 'successPage'])->name('payment.success');
    
   
});





//end of frontend routes




//Admin panel routes starts here

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login/post', [LoginController::class, 'loginPost'])->name('login.post');

    // Forget pass
    Route::get('/forget/password', [ForgetPasswordController::class, 'forgetPassword'])->name('admin.forget.password');
    Route::post('/forget/password/post', [ForgetPasswordController::class, 'forgetPasswordPost'])->name('admin.forget.password.post');
    Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('admin.reset.password');
    Route::post('/reset-password/{token}', [ForgetPasswordController::class, 'resetPasswordPost'])->name('admin.reset.password.post');


    Route::group(['middleware' => ['adminAuth']], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('admin.wishlist');
        Route::get('/coupons', [CouponController::class, 'coupons'])->name('admin.coupons');

        Route::get('/product/review/list', [ProductController::class, 'reviewList'])->name('admin.review.list');
        Route::post('/product/review/update/{id}', [ProductController::class, 'statusUpdate'])->name('admin.review.update');


        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'list'])->name('user.list');
            Route::get('/view/{id}', [UserController::class, 'view'])->name('user.profile');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('/block/{id}', [UserController::class, 'block'])->name('user.block');
            Route::get('/unblock/{id}', [UserController::class, 'unblock'])->name('user.unblock');
            Route::get('/change-password', [ChangePassword::class, 'changePassword'])->name('changePassword');
            Route::post('/change-password', [ChangePassword::class, 'changePasswordProcess'])->name('change.password.process');
        });

        
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', [SettingController::class, 'show'])->name('settings');
            Route::put('/update', [SettingController::class, 'settings'])->name('settings.update');

            Route::get('/shipping-index', [ShippingChargeController::class, 'index'])->name('shipping.index');
            Route::get('/shipping-create', [ShippingChargeController::class, 'create'])->name('shipping.create');
            Route::post('/shipping-store', [ShippingChargeController::class, 'store'])->name('shipping.store');
            Route::get('/shipping-edit/{id}', [ShippingChargeController::class, 'edit'])->name('shipping.edit');
            Route::post('/shipping-update/{id}', [ShippingChargeController::class, 'update'])->name('shipping.update');
            Route::get('/shipping-delete/{id}', [ShippingChargeController::class, 'delete'])->name('shipping.delete');




        });


        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('role.list');
            Route::get('/create', [RoleController::class, 'create'])->name('role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('role.store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
            Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update');
            Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [ProductController::class, 'list'])->name('admin.product.list');
            Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
            Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
            Route::get('/image/delete/{id}', [ProductController::class, 'imageDelete'])->name('admin.product.image.delete');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', [CategoryController::class, 'list'])->name('admin.category.list');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
            Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
        });


        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/', [SliderController::class, 'list'])->name('slider.list');
            Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
            Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
            Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
            Route::put('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
            Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
        });

        Route::group(['prefix' => 'customer'], function () {
            Route::get('/', [CustomerController::class, 'list'])->name('customer.list');
            Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
            Route::put('/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
            Route::get('/view/{id}', [CustomerController::class, 'view'])->name('customer.view');
            Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
            Route::get('/export', [CustomerController::class, 'excelExport'])->name('customer.export');
        });

        Route::group(['prefix' => 'location'], function () {
            Route::get('/division', [LocationController::class, 'list'])->name('division.list');
            Route::get('/division/create', [LocationController::class, 'create'])->name('division.create');
            Route::post('/division/store', [LocationController::class, 'store'])->name('division.store');
            Route::get('/division/delete/{division_id}', [LocationController::class, 'delete'])->name('division.delete');
        });

        Route::group(['prefix' => 'location'], function () {
            Route::get('/district/view/{id}', [LocationController::class, 'viewDistrict'])->name('district.view');
            Route::get('/district/create/{division_id}', [LocationController::class, 'createDistrict'])->name('district.createDistrict');
            Route::post('/district/store', [LocationController::class, 'storeDistrict'])->name('district.storeDistrict');
            Route::get('/district/delete/{district_id}', [LocationController::class, 'deleteDistrict'])->name('district.deleteDistrict');
        });

        Route::group(['prefix' => 'location'], function () {
            Route::get('/upazila/view/{id}', [LocationController::class, 'viewUpazila'])->name('upazila.view');
            Route::get('/upazila/create/{district_id}', [LocationController::class, 'createUpazila'])->name('upazila.create');
            Route::post('/upazila/store', [LocationController::class, 'storeUpazila'])->name('upazila.store');
            Route::get('/upazila/delete/{upazila_id}', [LocationController::class, 'deleteUpazila'])->name('upazila.delete');
        });

        Route::group(['prefix' => 'location'], function () {
            Route::get('/union/view/{id}', [LocationController::class, 'viewUnion'])->name('union.view');
            Route::get('/union/create/{upazila_id}', [LocationController::class, 'createUnion'])->name('union.create');
            Route::post('/union/store', [LocationController::class, 'storeUnion'])->name('union.store');
            Route::get('/union/delete/{union_id}', [LocationController::class, 'deleteUnion'])->name('union.delete');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', [OrderController::class, 'list'])->name('order.list');
            Route::get('/view/{id}', [OrderController::class, 'view'])->name('order.view');
            Route::put('/update/{id}', [OrderController::class, 'update'])->name('order.update');
            Route::get('/invoice/download{id}', [OrderController::class, 'invoice'])->name('invoice.download');
        });
    });
});
