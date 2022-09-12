<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use Auth;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=PrivacyPolicy::where('id',Auth::user()->id)->first();

        return view('Admin.privacy-policy.index',compact('data'));
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
            'privacypolicy_content' => 'required',
        ]);

        $data=array('privacypolicy_content'=>$request->privacypolicy_content);
        $privacypolicy=PrivacyPolicy::where('id',$request->id)->update($data);
        
        if ($privacypolicy) {
             return redirect()->back()->with('success', trans('messages.update'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }
}
