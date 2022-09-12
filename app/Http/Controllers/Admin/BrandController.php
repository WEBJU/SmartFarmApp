<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Brand::orderBy('id', 'DESC')->paginate(10);
        return view('Admin.brand.index',compact('data'));
    }

    public function add()
    {
        return view('Admin.brand.add');
    }

    public function list()
    {
        $data = Brand::all();
        return view('Admin.brand.brandtable',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data=Brand::where('brand_name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.brand.index',compact('data'));

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
            'brand_name' => 'required',
            'icon' => 'required|mimes:png',
        ]);
        
        $icon = 'brand-' . uniqid() . '.' . $request->icon->getClientOriginalExtension();
        $request->icon->move('storage/app/public/images/brand', $icon);

        $dataval=array('brand_name'=>$request->brand_name,'icon'=>$icon);
        $data=Brand::create($dataval);
        if ($data) {
             return redirect('admin/brand')->with('success', 'Brand has been added');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
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
        $data=Brand::find($id);
        if($data->icon){
            $data->img=url('storage/app/public/images/brand/'.$data->icon);
        }
        return view('Admin.brand.show',compact('data'));
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
            'brand_name' => 'required',
            'icon' => 'mimes:jpeg,png,jpg',
        ]);
        

        if(isset($request->icon)){

        	File::delete('storage/app/public/images/brand/' . $request->old_img);

            if($request->hasFile('icon')){
                $icon = $request->file('icon');
                $icon = 'brand-' . uniqid() . '.' . $request->icon->getClientOriginalExtension();
                $request->icon->move('storage/app/public/images/brand', $icon);

                $data=array('brand_name'=>$request->brand_name,'icon'=>$icon);
                $brand=Brand::find($request->brand_id)->update($data);
            }
        } else {
            $data=array('brand_name'=>$request->brand_name);
            $brand=Brand::find($request->brand_id)->update($data);
        }
        
        if ($brand) {
             return redirect('admin/brand')->with('success', 'Brand has been updated');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong');
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
        $data=Brand::where('id',$request->id)->delete();
        if($data) {
            return 1000;
        } else {
            return 2000;
        }
    }
    
    public function changeStatus(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'status' => 'required',
        ]);

        $data['status']=$request->status;
        Brand::where('id',$request->id)->update($data);
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }      
    }
}
