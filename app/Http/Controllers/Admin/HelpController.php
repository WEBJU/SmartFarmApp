<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Help;
use Auth;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data=Help::orderBy('id', 'DESC')->paginate(10);

        $parameter=array('status'=>'0');
        $update=Help::where('status','1')->update($parameter);

        return view('Admin.help.index',compact('data'));
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $data=Help::where(function ($query) use($keyword) {
                    $query->where('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('mobile', 'like', '%' . $keyword . '%');
                })
                ->orderBy('id', 'DESC')->paginate(10);

        return view('Admin.help.index',compact('data'));

    }
}
