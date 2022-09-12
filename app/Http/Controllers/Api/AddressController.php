<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function saveaddress(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"Please login to save address"],400);
        }

        if($request->first_name == ""){
            return response()->json(["status"=>0,"message"=>"Please enter first name"],400);
        }

        if($request->last_name == ""){
            return response()->json(["status"=>0,"message"=>"Please enter last name"],400);
        }

        if($request->street_address == ""){
            return response()->json(["status"=>0,"message"=>"Please enter address"],400);
        }

        if($request->pincode == ""){
            return response()->json(["status"=>0,"message"=>"Please enter pincode"],400);
        }

        if($request->mobile == ""){
            return response()->json(["status"=>0,"message"=>"Please enter mobile number"],400);
        }

        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>"Please enter email"],400);
        }

        $dataval=array('user_id'=>$request->user_id,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'street_address'=>$request->street_address,'landmark'=>$request->landmark,'pincode'=>$request->pincode,'mobile'=>$request->mobile,'email'=>$request->email);
        $data=Address::create($dataval);

        if($data)
        {
            return response()->json(['status'=>1,'message'=>'Success'],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
        }
    }

    public function getaddress(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>"Please login to check address"],400);
        }

        $addressdata=Address::where('user_id',$request->user_id)->get();

        if(!empty($addressdata))
        {
            return response()->json(['status'=>1,'message'=>'Success','data'=>$addressdata],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
        }        
    }

    public function editaddress(Request $request)
    {
        if($request->address_id == ""){
            return response()->json(["status"=>0,"message"=>"Invalid Address ID"],400);
        }

        if($request->first_name == ""){
            return response()->json(["status"=>0,"message"=>"Please enter first name"],400);
        }

        if($request->last_name == ""){
            return response()->json(["status"=>0,"message"=>"Please enter last name"],400);
        }

        if($request->street_address == ""){
            return response()->json(["status"=>0,"message"=>"Please enter address"],400);
        }

        if($request->pincode == ""){
            return response()->json(["status"=>0,"message"=>"Please enter pincode"],400);
        }

        if($request->mobile == ""){
            return response()->json(["status"=>0,"message"=>"Please enter mobile number"],400);
        }

        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>"Please enter email"],400);
        }

        $updatedata=array('first_name'=>$request->first_name,'last_name'=>$request->last_name,'street_address'=>$request->street_address,'landmark'=>$request->landmark,'pincode'=>$request->pincode,'mobile'=>$request->mobile,'email'=>$request->email);
        $data=Address::find($request->address_id)->update($updatedata);

        if($data)
        {
            return response()->json(['status'=>1,'message'=>'Success'],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
        }        
    }

    public function deleteaddress(Request $request)
    {
        if($request->address_id == ""){
            return response()->json(["status"=>0,"message"=>"Please login to check address"],400);
        }

        $data=Address::where('id',$request->address_id)->delete();

        if($data)
        {
            return response()->json(['status'=>1,'message'=>'Success'],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Something went wrong'],200);
        }        
    }
}
