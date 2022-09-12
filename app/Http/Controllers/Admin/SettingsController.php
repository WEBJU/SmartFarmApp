<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Settings::first();
        return view('Admin.settings.index',compact('data'));
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
            'firebase_key' => 'required',
            'currency' => 'required',
            'currency_position' => 'required',
            'min_balance' => 'required',
            'timezone' => 'required',
            'admin_commission' => 'required',
            'copyright' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'site_title' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);

        $data = new Settings;
        $data->exists = true;
        $data->id = $request->id;

        if(isset($request->logo)){
            if($request->hasFile('logo')){
                File::delete('storage/app/public/images/settings/' . $request->old_img);

                $logo = $request->file('logo');
                $logo = 'logo-' . uniqid() . '.' . $request->logo->getClientOriginalExtension();
                $request->logo->move('storage/app/public/images/settings', $logo);
                $data->logo=$logo;
            }            
        }

        if(isset($request->favicon)){
            if($request->hasFile('favicon')){
                File::delete('storage/app/public/images/settings/' . $request->old_favicon);

                $favicon = $request->file('favicon');
                $favicon = 'favicon-' . uniqid() . '.' . $request->favicon->getClientOriginalExtension();
                $request->favicon->move('storage/app/public/images/settings', $favicon);
                $data->favicon=$favicon;
            }            
        }

        if(isset($request->og_image)){
            if($request->hasFile('og_image')){
                File::delete('storage/app/public/images/settings/' . $request->old_og_image);

                $og_image = @$request->file('og_image');
                $og_image = 'og_image-' . uniqid() . '.' . @$request->og_image->getClientOriginalExtension();
                $request->og_image->move('storage/app/public/images/settings', $og_image);
                $data->og_image=$og_image;
            }            
        }

        $data->firebase_key =$request->firebase_key;
        $data->currency =$request->currency;
        $data->currency_position =$request->currency_position;
        $data->timezone =$request->timezone;
        $data->min_balance =$request->min_balance;
        $data->admin_commission =$request->admin_commission;
        $data->copyright =$request->copyright;
        $data->address =$request->address;
        $data->contact =$request->contact;
        $data->email =$request->email;
        $data->site_title =$request->site_title;
        $data->meta_title =$request->meta_title;
        $data->meta_description =$request->meta_description;
        $data->facebook =$request->facebook;
        $data->twitter =$request->twitter;
        $data->instagram =$request->instagram;
        $data->linkedin =$request->linkedin;
        $data->save();

        if ($data) {
             return redirect()->back()->with('success', trans('messages.update'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }
}
