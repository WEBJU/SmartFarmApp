<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsConditions;
use Auth;

class TermsConditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=TermsConditions::where('id',Auth::user()->id)->first();

        return view('Admin.terms-conditions.index',compact('data'));
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
        $this->validate($request,[
            'terms_conditions' => 'required',
        ]);

        $data=array('terms_conditions'=>$request->terms_conditions);
        $privacypolicy=TermsConditions::where('id',$request->id)->update($data);
        
        if ($privacypolicy) {
             return redirect()->back()->with('success', trans('messages.update'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }
}
