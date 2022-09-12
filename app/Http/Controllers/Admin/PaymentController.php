<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Payment::all();
        return view('Admin.payment.index',compact('data'));
    }

    public function managepayment($id)
    {
        $paymentdetails = Payment::where('id', $id)->get()->first();
        return view('Admin.payment.manage-payment', compact('paymentdetails'));
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
        $payment = new Payment;
        $payment->exists = true;
        $payment->id = $request->id;

        $payment->environment =$request->environment;
        $payment->test_public_key =$request->test_public_key;
        $payment->test_secret_key =$request->test_secret_key;
        $payment->live_public_key =$request->live_public_key;
        $payment->live_secret_key =$request->live_secret_key;
        $payment->encryption_key =$request->encryption_key;
        $payment->save();

        if ($payment) {
             return redirect('admin/payments')->with('success', trans('messages.update'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    public function changeStatus(Request $request)
    {
        $data['status']=$request->status;
        Payment::where('id',$request->id)->update($data);
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }      
    }
}
