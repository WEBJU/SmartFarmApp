<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Settings;
use App\Models\Products;
use App\Models\Bank;
use Hash;
use Auth;
use DB;
use Carbon\Carbon;
use Helper;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        if(Auth::user()->roles->first()->name == "super-admin") {

        	$ttlvendors = User::where('type','2')->get();
        	$ttlusers = User::where('type','3')->get();
            $ttlpayrequest = Payout::where('status','1')->get();
            $ttlproducts = Products::get();
            $ttlorders = Order::get();
            $ttlreturn = Order::where('status','9')->get();
            $ttlcancel = Order::where('status','5')->orWhere('status','6')->get();
            $ttlvalueofsales = Order::where('status','4')->sum('order_total');


            $orders = Order::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("SUM(order_total) as amount"))
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("created_at",">", Carbon::now()->subMonths(6))
                    ->get();

            $linereport = Order::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("count(id) as orders"))
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("created_at",">", Carbon::now()->subMonths(6))
                    ->get();

            $users = User::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("count(id) as total"))
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("type", '2')
                    ->where("created_at",">", Carbon::now()->subMonths(6))
                    ->get();

            $data=Order::with(['vendors'])->select('order_number','vendor_id','order_notes','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('SUM(order_total) AS grand_total'),\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('count(order_number) AS no_products'))
            ->groupBy('order_number')
            ->orderBy('id', 'DESC')
            ->paginate(6);

        }

        if(Auth::user()->roles->first()->name == "admin") {

            $ttlvendors = array();
            $ttlusers = array();
            $ttlpayrequest = Payout::where('vendor_id',Auth::user()->id)->where('status','1')->get();
            $ttlproducts = Products::where('vendor_id',Auth::user()->id)->get();
            $ttlorders = Order::where('vendor_id',Auth::user()->id)->get();
            $ttlreturn = Order::where('vendor_id',Auth::user()->id)->where('status','9')->get();
            $ttlcancel = Order::where('vendor_id',Auth::user()->id)->where('status','5')->orWhere('status','6')->get();
            $ttlvalueofsales = Order::where('vendor_id',Auth::user()->id)->where('status','4')->sum('order_total');


            $orders = Order::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("SUM(order_total) as amount"))
                    ->where('vendor_id',Auth::user()->id)
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("created_at",">", Carbon::now()->subMonths(6))
                    ->get();

            $linereport = Order::select(
                        DB::raw("MONTHNAME(created_at) as month_name"),
                        DB::raw("count(id) as orders"))
                    ->where('vendor_id',Auth::user()->id)
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("MONTHNAME(created_at)"))
                    ->where("created_at",">", Carbon::now()->subMonths(6))
                    ->get();

            $users = array();

            $data=Order::with(['vendors'])->select('order_number','vendor_id','order_notes','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('SUM(order_total) AS grand_total'),\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('count(order_number) AS no_products'))
            ->where('vendor_id',Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->groupBy('order_number')
            ->paginate(6);

        }

        return view('Admin.home',compact('ttlvendors','ttlusers','ttlpayrequest','ttlproducts','ttlorders','ttlreturn','ttlcancel','ttlvalueofsales','orders','linereport','users','data'));
    }

    public function changepassword(Request $request)
    {
        $this->validate($request,[
            'oldpassword'=>'required|min:6',
            'newpassword'=>'required|min:6',
            'confirmpassword'=>'required_with:newpassword|same:newpassword|min:6',
        ]);

        if(\Hash::check($request->oldpassword,Auth::user()->password)){
            $data=array('password'=>Hash::make($request->newpassword));
            $changepass=User::find(Auth::user()->id)->update($data);           
        }else{
            return 3;
        }

        if ($changepass) {
            return 1;
        } else {
            return 2;
        }
    }

    public function withdrawal(Request $request)
    {
        $this->validate($request,[
            'balance'=>'required',
        ]);

        $bankdetails=Bank::where('vendor_id', Auth::user()->id)->first();
        if (empty($bankdetails)) {
            return redirect()->back()->with('danger', "Please provide Bank information before making withdrawal request.");
        } else {
            $request_id = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);

            $checkbalance=Settings::select('min_balance','admin_commission')->first();

            if ($request->balance >= $checkbalance->min_balance) {

                $commission = ($request->balance*$checkbalance->admin_commission)/100;

                $paid_amount = $request->balance-$commission;
                
                $dataval=array('request_id'=>$request_id,'vendor_id'=>Auth::user()->id,'amount'=>$request->balance,'commission_pr'=>$checkbalance->admin_commission,'commission'=>$commission,'paid_amount'=>$paid_amount,'status'=>'1');
                $data=Payout::create($dataval);
                return redirect()->back()->with('success', "Withdrawal request has been sent");
            } else {
                return redirect()->back()->with('danger', "Insufficient balance at least ".Helper::CurrencyFormatter($checkbalance->min_balance)." required");
            }
        }
    }
}
