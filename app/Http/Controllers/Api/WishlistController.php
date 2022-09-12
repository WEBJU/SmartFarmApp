<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Products;

class WishlistController extends Controller
{
    public function addtowishlist(Request $request)
    {
        if($request->product_id == ""){
            return response()->json(["status"=>0,"message"=>"Invalid product ID"],400);
        }

        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"Please login to add Wishlist"],400);
        }

        $check=Wishlist::where('product_id',$request->product_id)
        ->where('user_id',$request->user_id)
        ->get();

        if (count($check) > 0) {
            return response()->json(['status'=>1,'message'=>'Already available in wishlist'],200);
        } else {
            $dataval=array('product_id'=>$request->product_id,'user_id'=>$request->user_id);
            $data=Wishlist::create($dataval);

            if(!empty($data))
            {
                return response()->json(['status'=>1,'message'=>'Success'],200);
            }
            else
            {
                return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
            }
        }
    }

    public function removefromwishlist(Request $request)
    {
        if($request->product_id == ""){
            return response()->json(["status"=>0,"message"=>"Invalid product ID"],400);
        }

        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"Please login to add wishlist"],400);
        }

        $data=Wishlist::where('product_id',$request->product_id)
        ->where('user_id',$request->user_id)
        ->delete();

        if(!empty($data))
        {
            return response()->json(['status'=>1,'message'=>'Success'],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
        }
    }

    public function getwishlist(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"Please login to check Wishlist"],400);
        }

        $user_id  = $request->user_id;

        $wishlistdata=Products::with(['productimage','variation','rattings'])
        ->select('products.id','products.product_name','products.product_price','products.discounted_price','products.is_variation','products.sku',\DB::raw('(case when wishlists.product_id is null then 0 else 1 end) as is_wishlist'))
        ->leftJoin('wishlists', function($query) use($user_id) {
                    $query->on('wishlists.product_id','=','products.id')
                    ->where('wishlists.user_id', '=', $user_id);
                })
        ->join('users','products.vendor_id','=','users.id')
        ->orderBy('products.id', 'DESC')
        ->where('users.is_available','1')
        ->where('products.status','1')
        ->where('wishlists.user_id',$request->user_id)
        ->paginate(10);

        if(!empty($wishlistdata))
        {
            return response()->json(['status'=>1,'message'=>'Success','data'=>$wishlistdata],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
        }        
    }
}