<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Products;
use File;

class LeftBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Banner::with('product')->with('category')->where('positions','left')->get();
        return view('Admin.leftbanner.index',compact('data'));
    }

    public function add()
    {
    	$data=Category::select('id','category_name')->get();
    	$products=Products::select('id','product_name')->get();
        return view('Admin.leftbanner.add',compact('data','products'));
    }

    public function list()
    {
    	$data = Banner::with('product')->with('category')->where('positions','left')->get();
        return view('Admin.leftbanner.leftbannertable',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);
        
        $image = 'leftbanner-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move('storage/app/public/images/banner', $image);

        $dataval=array('image'=>$image,'product_id'=>$request->product_id,'cat_id'=>$request->cat_id,'type'=>$request->type,'positions'=>"left");
        $data=Banner::create($dataval);
        if ($data) {
             return redirect('admin/leftbanner')->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Banner::find($id);
        $category=Category::select('id','category_name')->get();
        $products=Products::select('id','product_name')->get();
        if($data->image){
            $data->img=url('storage/app/public/images/banner/'.$data->image);
        }
        return view('Admin.leftbanner.show',compact('data','category','products'));
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
            'image' => 'mimes:jpeg,png,jpg',
        ]);
        

        if(isset($request->image)){

        	File::delete('storage/app/public/images/banner/' . $request->old_img);

            if($request->hasFile('image')){
                $image = $request->file('image');
                $image = 'leftbanner-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move('storage/app/public/images/banner', $image);

                $data=array('image'=>$image,'product_id'=>$request->product_id,'cat_id'=>$request->cat_id,'type'=>$request->type);
                $brand=Banner::find($request->brand_id)->update($data);
            }
        } else {
            $data=array('product_id'=>$request->product_id,'cat_id'=>$request->cat_id,'type'=>$request->type);
            $brand=Banner::find($request->brand_id)->update($data);
        }
        
        if ($brand) {
             return redirect('admin/leftbanner')->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
        ]);
        $data=Banner::where('id',$request->id)->delete();
        if($data) {
            return 1000;
        } else {
            return 2000;
        }
    }
}
