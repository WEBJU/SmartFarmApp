<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupons;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Coupons::orderBy('id', 'DESC')->paginate(10);
        return view('Admin.coupons.index',compact('data'));
    }

    public function add()
    {
        return view('Admin.coupons.add');
    }

    public function list()
    {
        $data = Coupons::all();
        return view('Admin.coupons.couponstable',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data=Coupons::where('coupon_name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.coupons.index',compact('data'));

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
            'coupon_name' => 'required',
            'type' => 'required',
            'quantity' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $dataval=array('coupon_name'=>$request->coupon_name,'type'=>$request->type,'quantity'=>$request->quantity,'start_date'=>$request->start_date,'end_date'=>$request->end_date,'percentage'=>$request->percentage,'amount'=>$request->amount,'times'=>$request->times);
        $data=Coupons::create($dataval);
        if ($data) {
             return redirect('admin/coupons')->with('success', trans('messages.success'));
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
        $data=Coupons::find($id);
        return view('Admin.coupons.show',compact('data'));
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
            'coupon_name' => 'required',
            'type' => 'required',
            'quantity' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $data=array('coupon_name'=>$request->coupon_name,'type'=>$request->type,'quantity'=>$request->quantity,'start_date'=>$request->start_date,'end_date'=>$request->end_date,'percentage'=>$request->percentage,'amount'=>$request->amount,'times'=>$request->times);

        $coupons=Coupons::find($request->coupon_id)->update($data);
        if ($coupons) {
             return redirect('admin/coupons')->with('success', trans('messages.update'));
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
        $data=Coupons::where('id',$request->id)->delete();
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
        Coupons::where('id',$request->id)->update($data);
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }      
    }
}
