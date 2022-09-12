<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use Auth;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data=Subscribe::orderBy('id', 'DESC')->paginate(10);

        return view('Admin.subscribe.index',compact('data'));
    }

    public function search(Request $request)
    {
        $data=Subscribe::where('email', 'like', '%' . $request->search . '%')
                ->orderBy('id', 'DESC')
                ->paginate(10);

        return view('Admin.subscribe.index',compact('data'));

    }
}
