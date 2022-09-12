<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Innersubcategory;
use App\Models\Products;

class InnerSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Innersubcategory::with('category')->with('subcategory')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.innersubcategory.index',compact('data'));
    }

    public function add()
    {
    	$data=Category::select('id','category_name')->get();
        return view('Admin.innersubcategory.add',compact('data'));
    }

    public function list()
    {
        $data = Subcategory::all();
        return view('Admin.innersubcategory.innersubcategorytable',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data=Innersubcategory::where('innersubcategory_name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.innersubcategory.index',compact('data'));

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
            'cat_id' => 'required',
            'subcat_id' => 'required',
            'innersubcategory_name' => 'required',
        ]);

        $cat_slug=Category::select('slug')->where('id',$request->cat_id)->first();
        $subcat_slug=Subcategory::select('slug')->where('id',$request->subcat_id)->first();

        $checkslug=Innersubcategory::where('slug',\Str::slug($request->innersubcategory_name))->first();

        if (@$checkslug->slug) {
            $dataval=array('cat_id'=>$request->cat_id,'subcat_id'=>$request->subcat_id,'innersubcategory_name'=>$request->innersubcategory_name,'slug'=>\Str::slug($cat_slug->slug.'-'.$subcat_slug->slug.'-'.$request->innersubcategory_name));
        } else {
            $dataval=array('cat_id'=>$request->cat_id,'subcat_id'=>$request->subcat_id,'innersubcategory_name'=>$request->innersubcategory_name,'slug'=>\Str::slug($request->innersubcategory_name));
        }

        
        $data=Innersubcategory::create($dataval);
        if ($data) {
             return redirect('admin/innersubcategory')->with('success', trans('messages.success'));
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
        $data=Innersubcategory::find($id);
        $category = Category::select('id','category_name')->get();
        $subcategory = Subcategory::select('id','subcategory_name')->get();
        return view('Admin.innersubcategory.show',compact('data','category','subcategory'));
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
            'cat_id' => 'required',
            'subcat_id' => 'required',
            'innersubcategory_name' => 'required',
        ]);

        $cat_slug=Category::select('slug')->where('id',$request->cat_id)->first();
        $subcat_slug=Subcategory::select('slug')->where('id',$request->subcat_id)->first();

        $checkslug=Innersubcategory::where('slug',\Str::slug($request->innersubcategory_name))->first();
        
        if (@$checkslug->slug) {
            $data=array('cat_id'=>$request->cat_id,'subcat_id'=>$request->subcat_id,'innersubcategory_name'=>$request->innersubcategory_name,'slug'=>\Str::slug($cat_slug->slug.'-'.$subcat_slug->slug.'-'.$request->innersubcategory_name));
            $subcategory=Innersubcategory::find($request->inner_cat_id)->update($data);
        } else {
            $dataval=array('cat_id'=>$request->cat_id,'subcat_id'=>$request->subcat_id,'innersubcategory_name'=>$request->innersubcategory_name,'slug'=>\Str::slug($request->innersubcategory_name));

            $data=array('cat_id'=>$request->cat_id,'subcat_id'=>$request->subcat_id,'innersubcategory_name'=>$request->innersubcategory_name,'slug'=>\Str::slug($request->innersubcategory_name));
            $subcategory=Innersubcategory::find($request->inner_cat_id)->update($data);
        }
        
        if ($subcategory) {
             return redirect('admin/innersubcategory')->with('success', trans('messages.update'));
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
        $data=Innersubcategory::where('id',$request->id)->delete();
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
        Innersubcategory::where('id',$request->id)->update($data);
        Products::where('innersubcat_id',$request->id)->delete();
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }      
    }

    public function subcat(Request $request)
    {
        $data=Subcategory::select('id','subcategory_name')->where('cat_id',$request->cat_id)->get();
        return json_encode($data);  
    }
}
