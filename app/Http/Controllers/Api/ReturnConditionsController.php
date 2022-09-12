<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReturnConditions;
use App\Models\Order;
use App\Models\Settings;
use App\Models\Notification;

class ReturnConditionsController extends Controller
{
    public function returnconditions(Request $request)
    {
        if($request->order_id == ""){
            return response()->json(["status"=>0,"message"=>"Order number is required"],400);
        }

        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"Please login"],400);
        }


        $order_info=Order::select('id','product_id','vendor_id','product_name','price','qty','status',\DB::raw('(case when variation is null then "" else variation end) as variation'),\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))
        ->where('id',$request->order_id)
        ->where('user_id',$request->user_id)
        ->first();

        $data=ReturnConditions::select('return_conditions')->get();

        if(!empty($data))
        {
            return response()->json(['status'=>1,'message'=>'Success','order_info'=>$order_info,'data'=>$data],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }      
    }

    public function returnrequest(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"User id is required"],400);
        }

        if($request->order_id == ""){
            return response()->json(["status"=>0,"message"=>"Order id is required"],400);
        }

        if($request->return_reason == ""){
            return response()->json(["status"=>0,"message"=>"Please select reason"],400);
        }

        $info=Order::select('product_name','order_number')
        ->where('id',$request->order_id)
        ->first();

        $gettimezone=Settings::select('timezone')->first();

        date_default_timezone_set($gettimezone->timezone);

        $return_number = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);

        $data=array('return_reason'=>$request->return_reason,'comment'=>$request->comment,'status'=>$request->status,'return_number'=>$return_number,'returned_at'=>date('Y-m-d h:i:s'));
        $order=Order::where('user_id',$request->user_id)->where('id',$request->order_id)->update($data);

        if(!empty($order))
        {
            $notification=array('user_id'=>$request->user_id,'order_id'=>$request->order_id,'order_number'=>$info->order_number,'order_status'=>$request->status,'message'=>"Return request for ".$info->product_name." has been raised",'is_read'=>"1",'type'=>"order");
            $store=Notification::create($notification);

            return response()->json(['status'=>1,'message'=>'Success'],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }
}
