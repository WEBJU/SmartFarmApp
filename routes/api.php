<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace'=>'Api'],function (){

	//Usermanagement
	Route::post('login','UserController@login');
	Route::post('register','UserController@register');
	Route::post('emailverify','UserController@emailverify');
	Route::post('editprofile','UserController@editprofile');
	Route::post('resendemailverification','UserController@resendemailverification');
	Route::post('getprofile','UserController@getprofile');
	Route::post('changepassword','UserController@changepassword');
	Route::post('forgotPassword','UserController@forgotPassword');
	Route::get('restaurantslocation','UserController@restaurantslocation');
	Route::post('contact','UserController@contact');
	Route::get('vendors','UserController@vendors');
	Route::post('vendorsregister','UserController@vendorsregister');

	//Homefeeds
	Route::post('homefeeds','HomeController@homefeeds');

	//Product
	Route::post('products','ProductsController@products');
	Route::post('viewalllisting','ProductsController@viewalllisting');
	Route::post('productdetails','ProductsController@productdetails');
	Route::post('vendorproducts','ProductsController@vendorproducts');
	Route::post('searchproducts','ProductsController@searchproducts');
	Route::post('filter','ProductsController@filter');

	//Wishlist
	Route::post('addtowishlist','WishlistController@addtowishlist');
	Route::post('removefromwishlist','WishlistController@removefromwishlist');
	Route::post('getwishlist','WishlistController@getwishlist');

	//Rattings
	Route::post('addratting','RattingController@addratting');
	Route::post('productreview','RattingController@productreview');

	//Categorymanagement
	Route::get('category','CategoryController@category');
	Route::post('subcategory','CategoryController@subcategory');

	//Bannermanagement
	Route::get('banner','BannerController@banner');

	//Brands
	Route::get('brands','BrandController@brands');
	Route::post('brandsproducts','BrandController@brandsproducts');

	//Address
	Route::post('saveaddress','AddressController@saveaddress');
	Route::post('getaddress','AddressController@getaddress');
	Route::post('editaddress','AddressController@editaddress');
	Route::post('deleteaddress','AddressController@deleteaddress');

	//Cart
	Route::post('addtocart','CartController@addtocart');
	Route::post('getcart','CartController@getcart');
	Route::post('deleteproduct','CartController@deleteproduct');
	Route::post('qtyupdate','CartController@qtyupdate');

	//Checkout
	Route::post('checkout','CheckoutController@checkout');

	//Payment list
	Route::post('paymentlist','PaymentController@paymentlist');

	//Order
	Route::post('order','OrderController@order');
	Route::post('orderhistory','OrderController@orderhistory');
	Route::post('orderdetails','OrderController@orderdetails');
	Route::post('cancelorder','OrderController@cancelorder');
	Route::post('trackorder','OrderController@trackorder');
	Route::post('wallet','OrderController@wallet');
	Route::post('recharge','OrderController@recharge');

	//Notification
	Route::post('notification','NotificationController@notification');
	Route::post('notificationread','NotificationController@notificationread');

	//Coupons
	Route::get('coupons','CouponsController@coupons');

	//Return conditions
	Route::post('returnconditions','ReturnConditionsController@returnconditions');
	Route::post('returnrequest','ReturnConditionsController@returnrequest');

	//PrivacyPolicy
	Route::get('cmspages','CMSController@index');

	//Help
	Route::post('help','UserController@help');
});