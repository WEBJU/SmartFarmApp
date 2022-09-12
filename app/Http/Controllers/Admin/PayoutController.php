<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payout;
use App\Models\User;
use App\Models\Settings;
use Auth;

class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->roles->first()->name == "admin") {
            $data=Payout::with(['vendors','bank'])->where('vendor_id',Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        }

        if(Auth::user()->roles->first()->name == "super-admin") {
            $data=Payout::with(['vendors','bank'])->orderBy('id', 'DESC')->paginate(10);
        }
        $getsettings=Settings::select('admin_commission')->first();

        return view('Admin.payout.index',compact('data','getsettings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $getsettings=Settings::select('timezone')->first();

        $payoutdetails=Payout::select('amount','commission')->first();

        date_default_timezone_set($getsettings->timezone);

        $data=array('status'=>'0','payment_method'=>$request->payment_method,'paid_at'=>date('Y-m-d h:i:s'));
        $returnpolicy=Payout::where('request_id',$request->request_id)->update($data);
        
        if ($returnpolicy) {

            if (Auth::user()->wallet > 0) {
                $amount = Auth::user()->wallet;
            } else {
                $amount = 0;
            }
            $adminwallet = $amount + $payoutdetails->commission;

            User::where('id', Auth::user()->id)
            ->update(['wallet' => $adminwallet]);

            $getvendordata=User::select('wallet')
            ->where('id',$request->vendor_id)
            ->first();

            if ($getvendordata->wallet > 0) {
                $vamount = $getvendordata->wallet;
            } else {
                $vamount = 0;
            }
            $vendorwallet = $vamount - $payoutdetails->amount;

            $vendorwallet = User::where('id', $request->vendor_id)
            ->update(['wallet' => $vendorwallet]);

             return redirect()->back()->with('success', trans('messages.update'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }
}
