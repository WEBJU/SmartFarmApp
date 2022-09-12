<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function notification(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"User id is required"],400);
        }

        $notifications=Notification::select('order_id','order_number','order_status','message','type',\DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as date'))
        ->where('user_id',$request->user_id)
        ->orderBy('id', 'DESC')
        ->paginate(10);

        if(!empty($notifications))
        {
            return response()->json(['status'=>1,'message'=>'Success','data'=>$notifications],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }

    public function notificationread(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"User id is required"],400);
        }
        
        $data=array('is_read'=>'0');
        $notifications=Notification::where('user_id',$request->user_id)->update($data);

        if(!empty($notifications))
        {
            return response()->json(['status'=>1,'message'=>'Success'],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.fail')],200);
        }
    }
}
