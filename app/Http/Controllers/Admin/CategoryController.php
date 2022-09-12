<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Products;
use App\Models\Subcategory;
use App\Models\Innersubcategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Category::orderBy('id', 'DESC')->paginate(10);
        return view('Admin.category.index',compact('data'));
    }

    public function add()
    {
        return view('Admin.category.add');
    }

    public function list()
    {
        $data = Category::all();
        return view('Admin.category.categorytable',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data=Category::where('category_name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.category.index',compact('data'));

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
            'category_name' => 'required',
            'icon' => 'required|mimes:png',
        ]);
        
        $icon = 'category-' . uniqid() . '.' . $request->icon->getClientOriginalExtension();
        $request->icon->move('storage/app/public/images/category', $icon);

        $dataval=array('category_name'=>$request->category_name,'icon'=>$icon,'slug'=>\Str::slug($request->category_name));
        $data=Category::create($dataval);
        if ($data) {
            return redirect('admin/category')->with('success', trans('messages.success'));
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
        $data=Category::find($id);
        if($data->icon){
            $data->img=url('storage/app/public/images/category/'.$data->icon);
        }
        return view('Admin.category.show',compact('data'));
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
            'category_name' => 'required',
            'icon' => 'mimes:jpeg,png,jpg',
        ]);

        if(isset($request->icon)){

        	File::delete('storage/app/public/images/category/' . $request->old_img);

            if($request->hasFile('icon')){
                $icon = $request->file('icon');
                $icon = 'category-' . uniqid() . '.' . $request->icon->getClientOriginalExtension();
                $request->icon->move('storage/app/public/images/category', $icon);

                $data=array('category_name'=>$request->category_name,'icon'=>$icon,'slug'=>\Str::slug($request->category_name));
                $category=Category::find($request->cat_id)->update($data);
            }
        } else {
            $data=array('category_name'=>$request->category_name,'slug'=>\Str::slug($request->category_name));
            $category=Category::find($request->cat_id)->update($data);
        }
        
        if ($category) {
             return redirect('admin/category')->with('success', trans('messages.update'));
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
        $data=Category::where('id',$request->id)->delete();
        Products::where('cat_id',$request->id)->delete();
        Subcategory::where('cat_id',$request->id)->delete();
        Innersubcategory::where('cat_id',$request->id)->delete();
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
        Category::where('id',$request->id)->update($data);
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }      
    }
}
