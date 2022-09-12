<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Products;
use App\Models\Innersubcategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Subcategory::with('category')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.subcategory.index',compact('data'));
    }

    public function add()
    {
    	$data=Category::select('id','category_name')->get();
        return view('Admin.subcategory.add',compact('data'));
    }

    public function list()
    {
        $data = Subcategory::all();
        return view('Admin.subcategory.subcategorytable',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data=Subcategory::where('subcategory_name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.subcategory.index',compact('data'));

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
            'subcategory_name' => 'required',
            'cat_id' => 'required',
        ]);

        $checkslug=Subcategory::where('slug',\Str::slug($request->subcategory_name))->first();

        if (@$checkslug->slug) {
            $cat_slug=Category::select('slug')->where('id',$request->cat_id)->first();

            $dataval=array('cat_id'=>$request->cat_id,'subcategory_name'=>$request->subcategory_name,'slug'=>\Str::slug($cat_slug->slug.'-'.$request->subcategory_name));
        } else {
            $dataval=array('cat_id'=>$request->cat_id,'subcategory_name'=>$request->subcategory_name,'slug'=>\Str::slug($request->subcategory_name));
        }

        
        $data=Subcategory::create($dataval);
        if ($data) {
             return redirect('admin/subcategory')->with('success', trans('messages.success'));
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
        $data=Subcategory::find($id);
        $category = Category::select('id','category_name')->get();
        return view('Admin.subcategory.show',compact('data','category'));
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
            'subcategory_name' => 'required',
            'cat_id' => 'required',
        ]);        

        $checkslug=Subcategory::where('slug',\Str::slug($request->subcategory_name))->first();

        if (@$checkslug->slug) {
            $cat_slug=Category::select('slug')->where('id',$request->cat_id)->first();

            $data=array('cat_id'=>$request->cat_id,'subcategory_name'=>$request->subcategory_name,'slug'=>\Str::slug($cat_slug->slug.'-'.$request->subcategory_name));
        } else {
            $data=array('cat_id'=>$request->cat_id,'subcategory_name'=>$request->subcategory_name,'slug'=>\Str::slug($request->subcategory_name));
        }

        $subcategory=Subcategory::find($request->subcat_id)->update($data);
        
        if ($subcategory) {
             return redirect('admin/subcategory')->with('success', trans('messages.update'));
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
        $data=Subcategory::where('id',$request->id)->delete();
        Products::where('subcat_id',$request->id)->delete();
        Innersubcategory::where('subcat_id',$request->id)->delete();
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
        Subcategory::where('id',$request->id)->update($data);
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }      
    }
}
