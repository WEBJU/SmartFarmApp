<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupons;
use Carbon\Carbon;
use Helper;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {

        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"User id is required"],400);
        }

        $orderdata=Order::select('coupon_name','user_id')->where('user_id',$request->user_id)->count();

        $coupons=Coupons::select('quantity','times','end_date','coupon_name','type','percentage','amount')
        ->where('status',1)
        ->where('coupon_name', $request->coupon_name)
        ->first();

        $now = Carbon::today()->toDateString();

        $cartdata=Cart::select('id','product_id','vendor_id','product_name','qty','price','attribute','variation','tax','shipping_cost',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))
        ->where('user_id', $request->user_id)
        ->orderBy('id', 'DESC')
        ->get();

        foreach ($cartdata as $value) {

            if ($request->coupon_name != "") {
                if (@$coupons->end_date >= $now) {
                    if ($coupons->quantity == 1) {
                        if ($orderdata > $coupons->times) {
                            return response()->json(['status'=>0,'message'=>'Coupon Usage Limit Has Been Reached'],200);
                        } else {

                            if ($coupons->type == "1") {
                                if ($value['price']*$value['qty'] > $coupons->amount) {
                                    $discount_amount = ($value['price']*$value['qty']) - $coupons->amount;
                                } else {
                                    return response()->json(['status'=>0,'message'=>'Each item amount should be more then '. Helper::CurrencyFormatter($coupons->amount)],200);
                                }
                            }

                            if ($coupons->type == "0") {
                                $discount_amount = ($value['price']*$value['qty'])*$coupons->percentage/100;
                            }
                        }
                    } else {
                        if ($coupons->type == "1") {
                            if ($value['price']*$value['qty'] > $coupons->amount) {
                                $discount_amount = ($value['price']*$value['qty']) - $coupons->amount;
                            } else {
                                return response()->json(['status'=>0,'message'=>'Amount should be more then '. Helper::CurrencyFormatter($coupons->amount)],200);
                            }
                        }

                        if ($coupons->type == "0") {
                            $discount_amount = ($value['price']*$value['qty'])*$coupons->percentage/100;
                        }
                    }
                } else{
                    return response()->json(['status'=>0,'message'=>'This coupon code is invalid or has expired.'],200);
                }
            }

            $cdata[] = array(
                'id' => $value['id'], 
                'product_id' => $value['product_id'],
                'product_name' => $value['product_name'], 
                'vendor_id' => $value['vendor_id'], 
                'qty' => $value['qty'],
                'price' => $value['price'],
                'attribute' => $value['attribute'],
                'variation' => $value['variation'],
                'tax' => $value['tax']*$value['qty'],
                'shipping_cost' => $value['shipping_cost'],
                'image_url' => $value['image_url'],
                'discount_amount' => @$discount_amount,
            );
        }

        $data=Cart::select('id',\DB::raw('SUM(price*qty) AS subtotal'),\DB::raw('SUM(tax*qty) AS tax'),\DB::raw('SUM(shipping_cost) AS shipping_cost'),'vendor_id')
        ->where('user_id', $request->user_id)
        ->first();

        if($data)
        {
            return response()->json(['status'=>1,'message'=>'Success','data'=>$data,'cartdata'=>$cdata,'coupon_name'=>@$coupons->coupon_name],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
        }
    }
}
