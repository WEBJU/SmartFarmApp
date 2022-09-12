<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ratting;

class RattingController extends Controller
{
    public function addratting(Request $request)
    {
        if($request->vendor_id == ""){
            return response()->json(["status"=>0,"message"=>"Invalid Seller ID"],400);
        }

        if($request->product_id == ""){
            return response()->json(["status"=>0,"message"=>"Invalid product ID"],400);
        }

        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"Please login to add Wishlist"],400);
        }

        if($request->ratting == ""){
            return response()->json(["status"=>0,"message"=>"Please select the rattings"],400);
        }

        if($request->comment == ""){
            return response()->json(["status"=>0,"message"=>"Please write comment"],400);
        }

        $checkratting = Ratting::select('ratting')
        ->where('product_id',$request->product_id)
        ->where('vendor_id',$request->vendor_id)
        ->where('user_id',$request->user_id)
        ->get();

        if (count($checkratting) > 0) {
            return response()->json(['status'=>0,'message'=>'You have already written the review.'],200);
        } else {
            $dataval=array('vendor_id'=>$request->vendor_id,'product_id'=>$request->product_id,'user_id'=>$request->user_id,'ratting'=>$request->ratting,'comment'=>$request->comment);
            $data=Ratting::create($dataval);

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

    public function productreview(Request $request)
    {
        if($request->product_id == ""){
            return response()->json(["status"=>0,"message"=>"Invalid product ID"],400);
        }

        $avg_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->get();
        $five_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','5')->get();
        $four_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','4')->get();
        $three_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','3')->get();
        $two_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','2')->get();
        $one_ratting = Ratting::select('ratting')->where('product_id',$request->product_id)->where('ratting','1')->get();

        $all_review = Ratting::with(['users'])->select('rattings.user_id','rattings.ratting','rattings.comment',\DB::raw('DATE_FORMAT(rattings.created_at, "%d-%m-%Y") as date'))->where('product_id',$request->product_id)->paginate(10);

        $rattings = array(
            'avg_ratting' => number_format($avg_ratting->avg('ratting'),1),
            'total' => count($avg_ratting),
            'five_ratting' => count($five_ratting),
            'four_ratting' => count($four_ratting),
            'three_ratting' => count($three_ratting),
            'two_ratting' => count($two_ratting),
            'one_ratting' => count($one_ratting),
        );

        if(!empty($rattings))
        {
            return response()->json(['status'=>1,'message'=>'Success','reviews'=>$rattings,'all_review'=>$all_review],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
        }
    }
}
