<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReturnConditions;

class ReturnConditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=ReturnConditions::all();
        return view('Admin.returnconditions.index',compact('data'));
    }

    public function add()
    {
        return view('Admin.returnconditions.add');
    }

    public function list()
    {
        $data = ReturnConditions::all();
        return view('Admin.returnconditions.returnconditionstable',compact('data'));
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
            'return_conditions' => 'required'
        ]);

        $dataval=array('return_conditions'=>$request->return_conditions);
        $data=ReturnConditions::create($dataval);
        if ($data) {
             return redirect('admin/returnconditions')->with('success', trans('messages.success'));
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
        $data=ReturnConditions::find($id);
        return view('Admin.returnconditions.show',compact('data'));
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
            'return_conditions' => 'required'
        ]);

        $data=array('return_conditions'=>$request->return_conditions);

        $returnconditions=ReturnConditions::find($request->return_id)->update($data);
        if ($returnconditions) {
             return redirect('admin/returnconditions')->with('success', trans('messages.update'));
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
        $data=ReturnConditions::where('id',$request->id)->delete();
        if($data) {
            return 1000;
        } else {
            return 2000;
        }
    }
}
