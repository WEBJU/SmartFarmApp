<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Products;

class BrandController extends Controller
{
    public function brands()
    {
        $vendors=Brand::select('id','brand_name',\DB::raw("CONCAT('".url('/storage/app/public/images/brand/')."/', icon) AS image_url"))
        ->where('status','1')
        ->orderBy('id', 'DESC')
        ->paginate(10);

        if ($vendors) {
            return response()->json(['status'=>1,'message'=>'Success','vendors'=>$vendors],200);
        } else {
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }

    public function brandsproducts(Request $request)
    {
        if($request->brand_id == ""){
            return response()->json(["status"=>0,"message"=>"Please select the brand"],400);
        }

        $user_id  = $request->user_id;

        $products=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
        ->leftJoin('wishlists', function($query) use($user_id) {
                    $query->on('wishlists.product_id','=','products.id')
                    ->where('wishlists.user_id', '=', $user_id);
                })
        ->join('users','products.vendor_id','=','users.id')
        ->orderBy('products.id', 'DESC')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('products.brand',$request->brand_id)
        ->paginate(10);

        if ($products) {
            return response()->json(['status'=>1,'message'=>'Success','data'=>$products],200);
        } else {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }
}
