<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Attribute::orderBy('id', 'DESC')->paginate(10);
        return view('Admin.attribute.index',compact('data'));
    }

    public function add()
    {
        return view('Admin.attribute.add');
    }

    public function list()
    {
        $data = Attribute::all();
        return view('Admin.attribute.attributetable',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data=Attribute::where('attribute', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.attribute.index',compact('data'));
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
            'attribute' => 'required'
        ]);

        $dataval=array('attribute'=>$request->attribute);
        $data=Attribute::create($dataval);
        if ($data) {
             return redirect('admin/attribute')->with('success', 'Attribute has been added');
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
        $data=Attribute::find($id);
        return view('Admin.attribute.show',compact('data'));
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
            'attribute' => 'required'
        ]);
        

        $data=array('attribute'=>$request->attribute);
        $attribute=Attribute::find($request->attribute_id)->update($data);
        
        if ($attribute) {
             return redirect('admin/attribute')->with('success', 'Attribute has been updated');
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
        $data=Attribute::where('id',$request->id)->delete();
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
        Attribute::where('id',$request->id)->update($data);
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }      
    }
}
