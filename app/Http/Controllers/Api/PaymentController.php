<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    public function paymentlist(Request $request)
    {

        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"Please login to save address"],400);
        }

        $walletamount=User::select('wallet')->where('id',$request->user_id)->first();

        $paymentlist=Payment::where('status','1')->get();
        return response()->json(['status'=>1,'message'=>'Success','paymentlist'=>$paymentlist,'walletamount'=>$walletamount->wallet],200);
    }
}