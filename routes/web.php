<?php

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

Route::get('/', function () {
    return view('Admin.auth.login');
});


//Admin Route
Route::group(['prefix'=>'admin','namespace'=>"Admin"], function() {

	// Route::get('/verification', function () {
	//     return view('Admin.auth.verification');
	// });

	Route::get('/otp-verify', function () {
	    return view('Admin.auth.otp-verify');
	});
	// Route::post('systemverification', 'AuthController@systemverification')->name('admin.systemverification');
	Route::post('otp_verification', 'AuthController@otp_verification')->name('admin.otp_verification');

	Route::get('login', 'AuthController@login')->name('admin.login');
	Route::post('login', 'AuthController@doLogin')->name('admin.dologin');

	Route::group(['middleware' => 'AdminAuth'], function () {
		// Home
		Route::get('/', 'HomeController@index')->name('admin.home');
		Route::post('/withdrawal', 'HomeController@withdrawal')->name('admin.withdrawal');
		Route::post('/changepassword', 'HomeController@changepassword')->name('admin.changepassword');

		// Category
		Route::group(['prefix' => 'category'], function () {
			Route::get('/', 'CategoryController@index')->name('admin.category');
			Route::get('/add', 'CategoryController@add')->name('admin.category.add');
			Route::get('/show/{id}', 'CategoryController@show')->name('admin.category.show');
			Route::get('/list', 'CategoryController@list')->name('admin.category.list');
			Route::get('/search', 'CategoryController@search')->name('admin.category.search');
			Route::post('/store', 'CategoryController@store')->name('admin.category.store');
			Route::post('/update', 'CategoryController@update')->name('admin.category.update');
			Route::post('/delete', 'CategoryController@destroy')->name('admin.category.delete');
			Route::post('/change/status', 'CategoryController@changeStatus')->name('admin.category.changeStatus');
		});

		// Subcategory
		Route::group(['prefix' => 'subcategory'], function () {
			Route::get('/', 'SubCategoryController@index')->name('admin.subcategory');
			Route::get('/add', 'SubCategoryController@add')->name('admin.subcategory.add');
			Route::get('/show/{id}', 'SubCategoryController@show')->name('admin.subcategory.show');
			Route::get('/list', 'SubCategoryController@list')->name('admin.subcategory.list');
			Route::get('/search', 'SubCategoryController@search')->name('admin.subcategory.search');
			Route::post('/store', 'SubCategoryController@store')->name('admin.subcategory.store');
			Route::post('/update', 'SubCategoryController@update')->name('admin.subcategory.update');
			Route::post('/delete', 'SubCategoryController@destroy')->name('admin.subcategory.delete');
			Route::post('/change/status', 'SubCategoryController@changeStatus')->name('admin.subcategory.changeStatus');
		});

		// InnerSubcategory
		Route::group(['prefix' => 'innersubcategory'], function () {
			Route::get('/', 'InnerSubCategoryController@index')->name('admin.innersubcategory');
			Route::get('/add', 'InnerSubCategoryController@add')->name('admin.innersubcategory.add');
			Route::get('/show/{id}', 'InnerSubCategoryController@show')->name('admin.innersubcategory.show');
			Route::get('/list', 'InnerSubCategoryController@list')->name('admin.innersubcategory.list');
			Route::get('/search', 'InnerSubCategoryController@search')->name('admin.innersubcategory.search');
			Route::post('/store', 'InnerSubCategoryController@store')->name('admin.innersubcategory.store');
			Route::post('/update', 'InnerSubCategoryController@update')->name('admin.innersubcategory.update');
			Route::post('/delete', 'InnerSubCategoryController@destroy')->name('admin.innersubcategory.delete');
			Route::post('/change/status', 'InnerSubCategoryController@changeStatus')->name('admin.innersubcategory.changeStatus');
			Route::post('/change/subcat', 'InnerSubCategoryController@subcat')->name('admin.innersubcategory.subcat');
		});

		// Color
		Route::group(['prefix' => 'color'], function () {
			Route::get('/', 'ColorController@index')->name('admin.color');
			Route::get('/add', 'ColorController@add')->name('admin.color.add');
			Route::get('/show/{id}', 'ColorController@show')->name('admin.color.show');
			Route::get('/list', 'ColorController@list')->name('admin.color.list');
			Route::post('/store', 'ColorController@store')->name('admin.color.store');
			Route::post('/update', 'ColorController@update')->name('admin.color.update');
			Route::post('/delete', 'ColorController@destroy')->name('admin.color.delete');
			Route::post('/change/status', 'ColorController@changeStatus')->name('admin.color.changeStatus');
		});

		// Attribute
		Route::group(['prefix' => 'attribute'], function () {
			Route::get('/', 'AttributeController@index')->name('admin.attribute');
			Route::get('/add', 'AttributeController@add')->name('admin.attribute.add');
			Route::get('/show/{id}', 'AttributeController@show')->name('admin.attribute.show');
			Route::get('/list', 'AttributeController@list')->name('admin.attribute.list');
			Route::get('/search', 'AttributeController@search')->name('admin.attribute.search');
			Route::post('/store', 'AttributeController@store')->name('admin.attribute.store');
			Route::post('/update', 'AttributeController@update')->name('admin.attribute.update');
			Route::post('/delete', 'AttributeController@destroy')->name('admin.attribute.delete');
			Route::post('/change/status', 'AttributeController@changeStatus')->name('admin.attribute.changeStatus');
		});

		// Brand
		Route::group(['prefix' => 'brand'], function () {
			Route::get('/', 'BrandController@index')->name('admin.brand');
			Route::get('/add', 'BrandController@add')->name('admin.brand.add');
			Route::get('/show/{id}', 'BrandController@show')->name('admin.brand.show');
			Route::get('/list', 'BrandController@list')->name('admin.brand.list');
			Route::get('/search', 'BrandController@search')->name('admin.brand.search');
			Route::post('/store', 'BrandController@store')->name('admin.brand.store');
			Route::post('/update', 'BrandController@update')->name('admin.brand.update');
			Route::post('/delete', 'BrandController@destroy')->name('admin.brand.delete');
			Route::post('/change/status', 'BrandController@changeStatus')->name('admin.brand.changeStatus');
		});

		// Products
		Route::group(['prefix' => 'products'], function () {
			Route::get('/', 'ProductController@index')->name('admin.products');
			Route::get('/add', 'ProductController@add')->name('admin.products.add');
			Route::get('/show/{id}', 'ProductController@show')->name('admin.products.show');
			Route::get('/list', 'ProductController@list')->name('admin.products.list');
			Route::get('/search', 'ProductController@search')->name('admin.products.search');
			Route::post('/store', 'ProductController@store')->name('admin.products.store');
			Route::post('/update', 'ProductController@update')->name('admin.products.update');
			Route::post('/delete', 'ProductController@destroy')->name('admin.products.delete');
			Route::post('/change/status', 'ProductController@changeStatus')->name('admin.products.changeStatus');
			Route::post('/change/subcat', 'ProductController@subcat')->name('admin.products.subcat');
			Route::post('/change/innersubcat', 'ProductController@innersubcat')->name('admin.products.innersubcat');
			Route::post('/showimage', 'ProductController@showimage')->name('admin.products.showimage');
			Route::post('/updateimage', 'ProductController@updateimage')->name('admin.products.updateimage');
			Route::post('/destroyimage', 'ProductController@destroyimage')->name('admin.products.destroyimage');
			Route::post('/storeimages', 'ProductController@storeimages')->name('admin.products.storeimages');
		});

		// Variation
		Route::group(['prefix' => 'variation'], function () {
			Route::post('/delete', 'VariationController@destroy')->name('admin.variation.delete');
		});

		// Slider
		Route::group(['prefix' => 'slider'], function () {
			Route::get('/', 'SliderController@index')->name('admin.slider');
			Route::get('/add', 'SliderController@add')->name('admin.slider.add');
			Route::get('/show/{id}', 'SliderController@show')->name('admin.slider.show');
			Route::get('/list', 'SliderController@list')->name('admin.slider.list');
			Route::post('/store', 'SliderController@store')->name('admin.slider.store');
			Route::post('/update', 'SliderController@update')->name('admin.slider.update');
			Route::post('/delete', 'SliderController@destroy')->name('admin.slider.delete');
			Route::post('/change/status', 'SliderController@changeStatus')->name('admin.slider.changeStatus');
		});

		// Banner
		Route::group(['prefix' => 'banner'], function () {
			Route::get('/', 'BannerController@index')->name('admin.banner');
			Route::get('/add', 'BannerController@add')->name('admin.banner.add');
			Route::get('/show/{id}', 'BannerController@show')->name('admin.banner.show');
			Route::get('/list', 'BannerController@list')->name('admin.banner.list');
			Route::post('/store', 'BannerController@store')->name('admin.banner.store');
			Route::post('/update', 'BannerController@update')->name('admin.banner.update');
			Route::post('/delete', 'BannerController@destroy')->name('admin.banner.delete');
			Route::post('/change/status', 'BannerController@changeStatus')->name('admin.banner.changeStatus');
		});

		// LargeBanner
		Route::group(['prefix' => 'largebanner'], function () {
			Route::get('/', 'LargeBannerController@index')->name('admin.largebanner');
			Route::get('/add', 'LargeBannerController@add')->name('admin.largebanner.add');
			Route::get('/show/{id}', 'LargeBannerController@show')->name('admin.largebanner.show');
			Route::get('/list', 'LargeBannerController@list')->name('admin.largebanner.list');
			Route::post('/store', 'LargeBannerController@store')->name('admin.largebanner.store');
			Route::post('/update', 'LargeBannerController@update')->name('admin.largebanner.update');
			Route::post('/delete', 'LargeBannerController@destroy')->name('admin.largebanner.delete');
			Route::post('/change/status', 'LargeBannerController@changeStatus')->name('admin.largebanner.changeStatus');
		});

		// LeftBanner
		Route::group(['prefix' => 'leftbanner'], function () {
			Route::get('/', 'LeftBannerController@index')->name('admin.leftbanner');
			Route::get('/add', 'LeftBannerController@add')->name('admin.leftbanner.add');
			Route::get('/show/{id}', 'LeftBannerController@show')->name('admin.leftbanner.show');
			Route::get('/list', 'LeftBannerController@list')->name('admin.leftbanner.list');
			Route::post('/store', 'LeftBannerController@store')->name('admin.leftbanner.store');
			Route::post('/update', 'LeftBannerController@update')->name('admin.leftbanner.update');
			Route::post('/delete', 'LeftBannerController@destroy')->name('admin.leftbanner.delete');
			Route::post('/change/status', 'LeftBannerController@changeStatus')->name('admin.leftbanner.changeStatus');
		});

		// BottomBanner
		Route::group(['prefix' => 'bottombanner'], function () {
			Route::get('/', 'BottomBannerController@index')->name('admin.bottombanner');
			Route::get('/add', 'BottomBannerController@add')->name('admin.bottombanner.add');
			Route::get('/show/{id}', 'BottomBannerController@show')->name('admin.bottombanner.show');
			Route::get('/list', 'BottomBannerController@list')->name('admin.bottombanner.list');
			Route::post('/store', 'BottomBannerController@store')->name('admin.bottombanner.store');
			Route::post('/update', 'BottomBannerController@update')->name('admin.bottombanner.update');
			Route::post('/delete', 'BottomBannerController@destroy')->name('admin.bottombanner.delete');
			Route::post('/change/status', 'BottomBannerController@changeStatus')->name('admin.bottombanner.changeStatus');
		});

		// PopupBanner
		Route::group(['prefix' => 'popupbanner'], function () {
			Route::get('/', 'PopupBannerController@index')->name('admin.popupbanner');
			Route::get('/add', 'PopupBannerController@add')->name('admin.popupbanner.add');
			Route::get('/show/{id}', 'PopupBannerController@show')->name('admin.popupbanner.show');
			Route::get('/list', 'PopupBannerController@list')->name('admin.popupbanner.list');
			Route::post('/store', 'PopupBannerController@store')->name('admin.popupbanner.store');
			Route::post('/update', 'PopupBannerController@update')->name('admin.popupbanner.update');
			Route::post('/delete', 'PopupBannerController@destroy')->name('admin.popupbanner.delete');
			Route::post('/change/status', 'PopupBannerController@changeStatus')->name('admin.popupbanner.changeStatus');
		});

		// Coupons
		Route::group(['prefix' => 'coupons'], function () {
			Route::get('/', 'CouponsController@index')->name('admin.coupons');
			Route::get('/add', 'CouponsController@add')->name('admin.coupons.add');
			Route::get('/show/{id}', 'CouponsController@show')->name('admin.coupons.show');
			Route::get('/list', 'CouponsController@list')->name('admin.coupons.list');
			Route::get('/search', 'CouponsController@search')->name('admin.coupons.search');
			Route::post('/store', 'CouponsController@store')->name('admin.coupons.store');
			Route::post('/update', 'CouponsController@update')->name('admin.coupons.update');
			Route::post('/delete', 'CouponsController@destroy')->name('admin.coupons.delete');
			Route::post('/change/status', 'CouponsController@changeStatus')->name('admin.coupons.changeStatus');
		});

		// Return conditions
		Route::group(['prefix' => 'returnconditions'], function () {
			Route::get('/', 'ReturnConditionsController@index')->name('admin.returnconditions');
			Route::get('/add', 'ReturnConditionsController@add')->name('admin.returnconditions.add');
			Route::get('/show/{id}', 'ReturnConditionsController@show')->name('admin.returnconditions.show');
			Route::get('/list', 'ReturnConditionsController@list')->name('admin.returnconditions.list');
			Route::post('/store', 'ReturnConditionsController@store')->name('admin.returnconditions.store');
			Route::post('/update', 'ReturnConditionsController@update')->name('admin.returnconditions.update');
			Route::post('/delete', 'ReturnConditionsController@destroy')->name('admin.returnconditions.delete');
		});

		// Vendors
		Route::group(['prefix' => 'vendors'], function () {
			Route::get('/', 'VendorController@index')->name('admin.vendors');
			Route::get('/add', 'VendorController@add')->name('admin.vendors.add');
			Route::post('/store', 'VendorController@store')->name('admin.vendors.store');
			Route::get('/vendor-profile', 'VendorController@vendorprofile')->name('admin.vendor-profile');
			Route::post('/update', 'VendorController@update')->name('admin.vendors.update');
			Route::get('/search', 'VendorController@search')->name('admin.vendors.search');
			Route::post('/change/status', 'VendorController@changeStatus')->name('admin.vendors.changeStatus');
			Route::get('/vendor-details/{id}', 'VendorController@vendordetails')->name('admin.vendors.vendordetails');
			Route::post('/delete', 'VendorController@destroy')->name('admin.vendors.delete');
		});

		// Users
		Route::group(['prefix' => 'users'], function () {
			Route::get('/', 'UserController@index')->name('admin.users');
			Route::get('/user-profile', 'UserController@vendorprofile')->name('admin.user-profile');
			Route::post('/update', 'UserController@update')->name('admin.users.update');
			Route::get('/search', 'UserController@search')->name('admin.users.search');
			Route::post('/change/status', 'UserController@changeStatus')->name('admin.users.changeStatus');
			Route::get('/user-details/{id}', 'UserController@vendordetails')->name('admin.users.vendordetails');
			Route::post('/delete', 'UserController@destroy')->name('admin.users.delete');
		});

		// Payments
		Route::group(['prefix' => 'payments'], function () {
			Route::get('/', 'PaymentController@index')->name('admin.payments');
			Route::post('/change/status', 'PaymentController@changeStatus')->name('admin.payments.changeStatus');
			Route::get('/manage-payment/{id}', 'PaymentController@managepayment')->name('admin.payments.managepayment');
			Route::post('/update', 'PaymentController@update')->name('admin.payments.update');
		});

		// Settings
		Route::group(['prefix' => 'settings'], function () {
			Route::get('/', 'SettingsController@index')->name('admin.settings');
			Route::post('/update', 'SettingsController@update')->name('admin.settings.update');
		});

		// Return policy
		Route::group(['prefix' => 'return-policy'], function () {
			Route::get('/', 'ReturnPolicyController@index')->name('admin.return-policy');
			Route::post('/update', 'ReturnPolicyController@update')->name('admin.return-policy.update');
		});

		// Payout
		Route::group(['prefix' => 'payout'], function () {
			Route::get('/', 'PayoutController@index')->name('admin.payout');
			Route::post('/update', 'PayoutController@update')->name('admin.payout.update');
		});

		// Help
		Route::group(['prefix' => 'help'], function () {
			Route::get('/', 'HelpController@index')->name('admin.help');
			Route::get('/search', 'HelpController@search')->name('admin.help.search');
		});

		// Orders
		Route::group(['prefix' => 'orders'], function () {
			Route::get('/', 'OrderController@index')->name('admin.orders');
			Route::get('/order-details/{id}', 'OrderController@orderdetails')->name('admin.payments.orderdetails');
			Route::post('/update', 'OrderController@update')->name('admin.orders.update');
			Route::post('/delete', 'OrderController@delete')->name('admin.orders.delete');
			Route::get('/search', 'OrderController@search')->name('admin.orders.search');
			Route::post('/change/status', 'OrderController@changeStatus')->name('admin.orders.changeStatus');
		});

		// Return Orders
		Route::group(['prefix' => 'returnorders'], function () {
			Route::get('/', 'ReturnOrderController@index')->name('admin.returnorders');
			Route::get('/order-details/{id}', 'ReturnOrderController@orderdetails')->name('admin.returnorders.orderdetails');
			Route::get('/search', 'ReturnOrderController@search')->name('admin.returnorders.search');
			Route::post('/change/status', 'ReturnOrderController@changeStatus')->name('admin.returnorders.changeStatus');
		});

		// About
		Route::group(['prefix' => 'about'], function () {
			Route::get('/', 'AboutController@index')->name('admin.about');
			Route::post('/update', 'AboutController@update')->name('admin.about.update');
		});

		// privacy-policy
		Route::group(['prefix' => 'privacy-policy'], function () {
			Route::get('/', 'PrivacyPolicyController@index')->name('admin.privacy-policy');
			Route::post('/update', 'PrivacyPolicyController@update')->name('admin.privacy-policy.update');
		});

		// terms-conditions
		Route::group(['prefix' => 'terms-conditions'], function () {
			Route::get('/', 'TermsConditionsController@index')->name('admin.terms-conditions');
			Route::post('/update', 'TermsConditionsController@update')->name('admin.terms-conditions.update');
		});

		// Subscribe
		Route::group(['prefix' => 'subscribe'], function () {
			Route::get('/', 'SubscribeController@index')->name('admin.subscribe');
			Route::get('/search', 'SubscribeController@search')->name('admin.subscribe.search');
		});

		Route::get('logout', 'AuthController@logout')->name('admin.logout');
	});
});