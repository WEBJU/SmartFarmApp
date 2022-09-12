<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupons;
use App\Models\Order;
use Carbon\Carbon;

class CouponsController extends Controller
{
    public function coupons()
    {
        $now = Carbon::today()->toDateString();

        $coupons=Coupons::select('coupon_name','type','percentage','amount',\DB::raw('DATE_FORMAT(start_date, "%d-%m-%Y") as start_date'),\DB::raw('DATE_FORMAT(end_date, "%d-%m-%Y") as end_date'))
        ->where('status',1)
        ->where('start_date', '<=', $now)
        ->where('end_date', '>=', $now)
        ->orderBy('id', 'DESC')
        ->paginate(10);

        if(!empty($coupons))
        {
            return response()->json(['status'=>1,'message'=>'Success','data'=>$coupons],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }

    public function applycoupons(Request $request)
    {
        if($request->coupon_name == ""){
            return response()->json(["status"=>0,"message"=>"Please apply coupon"],400);
        }

        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"User id is required"],400);
        }

        $orderdata=Order::select('coupon_name','user_id')->where('user_id',$request->user_id)->count();

        $coupons=Coupons::select('quantity','times','end_date','coupon_name','type','percentage','amount')
        ->where('status',1)
        ->where('coupon_name', $request->coupon_name)
        ->first();

        $now = Carbon::today()->toDateString();

        if ($coupons->end_date >= $now) {
            if ($coupons->quantity == 1) {
                if ($orderdata > $coupons->times) {
                    return response()->json(['status'=>0,'message'=>'Coupon Usage Limit Has Been Reached'],200);
                } else {
                    return response()->json(['status'=>1,'message'=>'Success','data'=>$coupons],200);
                }
            } else {
                return response()->json(['status'=>1,'message'=>'Success','data'=>$coupons],200);
            }
        } else{
            return response()->json(['status'=>0,'message'=>'This coupon code is invalid or has expired.'],200);
        }
    }
}
