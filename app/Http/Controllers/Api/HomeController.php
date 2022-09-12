<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\User;
use App\Models\Brand;
use App\Models\Notification;
use App\Models\Settings;

class HomeController extends Controller
{
    public function homefeeds(Request $request)
    {
        $user_id  = $request->user_id;

        $featured_products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->where('users.is_available','1')
        ->where('products.is_featured','1')
        ->where('products.status','1')
        ->inRandomOrder()->limit(10)->get();

        $hot_products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->where('products.is_hot','1')
        ->where('products.status','1')
        ->inRandomOrder()->limit(10)->get();

        $new_products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
        ->leftJoin('wishlists', function($query) use($user_id) {
            $query->on('wishlists.product_id','=','products.id')
            ->where('wishlists.user_id', '=', $user_id);
        })
        ->join('users','products.vendor_id','=','users.id')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->orderBy('products.id', 'DESC')
        ->get()->take(10);

        $vendors=User::select('id','name',\DB::raw("CONCAT('".url('/storage/app/public/images/profile/')."/', profile_pic) AS image_url"))
        ->where('type','3')
        ->where('is_available','1')
        ->inRandomOrder()->limit(10)->get();

        $brands=Brand::select('id','brand_name',\DB::raw("CONCAT('".url('/storage/app/public/images/brand/')."/', icon) AS image_url"))
        ->where('status','1')
        ->orderBy('id', 'DESC')
        ->inRandomOrder()->limit(10)->get();

        $notifications=Notification::where('is_read','1')->where('user_id',$user_id)->count();

        $data=Settings::first();

        if(!empty($featured_products))
        {
            return response()->json(['status'=>1,'message'=>'Success','currency'=>$data->currency,'currency_position'=>$data->currency_position,'featured_products'=>$featured_products,'hot_products'=>$hot_products,'new_products'=>$new_products,'vendors'=>$vendors,'brands'=>$brands,'notifications'=>$notifications],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }
}
