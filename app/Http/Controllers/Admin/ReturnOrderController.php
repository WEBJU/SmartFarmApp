<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use Helper;

class ReturnOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->roles->first()->name == "super-admin") {
            $data=Order::with(['vendors'])->select('vendor_id','return_number','full_name','email','mobile','product_name','status','order_total',\DB::raw('DATE_FORMAT(returned_at, "%d %M %Y") as date'))
            ->where('status','7')
            ->orWhere('status','8')
            ->orWhere('status','9')
            ->orWhere('status','10')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        } 
        if(Auth::user()->roles->first()->name == "admin") {
            $data=Order::select('return_number','full_name','email','mobile','product_name','status','order_total',\DB::raw('DATE_FORMAT(returned_at, "%d %M %Y") as date'))
            ->where('vendor_id',Auth::user()->id)
            ->where('status','7')
            ->orWhere('status','8')
            ->orWhere('status','9')
            ->orWhere('status','10')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        }

        return view('Admin.returnorders.index',compact('data'));
    }

    public function search(Request $request)
    {

        if(Auth::user()->roles->first()->name == "super-admin") {
            $data=Order::with(['vendors'])->select('vendor_id','return_number','full_name','email','mobile','product_name','status','order_total',\DB::raw('DATE_FORMAT(returned_at, "%d %M %Y") as date'))
            ->where('status','7')
            ->orWhere('return_number', 'LIKE', '%' . $request->search . '%')
            ->orWhere('status','8')
            ->orWhere('status','9')
            ->orWhere('status','10')
            ->orWhere('full_name', 'LIKE', '%' . $request->search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        } 
        if(Auth::user()->roles->first()->name == "admin") {
            $data=Order::select('return_number','full_name','email','mobile','product_name','status','order_total',\DB::raw('DATE_FORMAT(returned_at, "%d %M %Y") as date'))
            ->where('vendor_id',Auth::user()->id)
            ->where('status','7')
            ->orWhere('return_number', 'LIKE', '%' . $request->search . '%')
            ->orWhere('status','8')
            ->orWhere('status','9')
            ->orWhere('status','10')
            ->orWhere('full_name', 'LIKE', '%' . $request->search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        }
        return view('Admin.returnorders.index',compact('data'));

    }

    public function orderdetails($id)
    {
        $order_info=Order::with(['vendors'])->select('id','vendor_id','return_number','return_reason','vendor_comment','comment','order_number','order_notes','payment_type','payment_id','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as date'),\DB::raw('DATE_FORMAT(returned_at, "%d-%m-%Y") as returned_at'),\DB::raw('DATE_FORMAT(accepted_at, "%d-%m-%Y") as accepted_at'),\DB::raw('DATE_FORMAT(completed_at, "%d-%m-%Y") as completed_at'),\DB::raw('DATE_FORMAT(rejected_at, "%d-%m-%Y") as rejected_at'),\DB::raw('SUM(price*qty) AS subtotal'),\DB::raw('SUM(tax*qty) AS tax'),\DB::raw('SUM(shipping_cost) AS shipping_cost'),\DB::raw('SUM(order_total) AS grand_total'))
        ->where('return_number',$id)
        ->orderBy('id', 'DESC')
        ->first();

        $order_data=Order::select('id','product_id','product_name','price','qty','tax','status','discount_amount','order_total',\DB::raw('(case when variation is null then "" else variation end) as variation'),\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"),'shipping_cost')
        ->where('return_number',$id)
        ->get();

        return view('Admin.returnorders.order-details',compact('order_info','order_data'));
    }

    public function delete()
    {
        $data=Order::where('vendor_id',Auth::user()->id)->get();
        return view('Admin.returnorders.index',compact('data'));
    }

    public function changeStatus(Request $request)
    {

        $status=Order::select('order_total','product_name','payment_id','user_id','vendor_id','payment_type','order_number','return_number')
        ->where('id',$request->id)
        ->first();

        if ($request->status == 7) {
            $data=array('status'=>$request->status);
            Order::where('id',$request->id)->update($data);

            $message = "";
        }

        if ($request->status == 8) {
            $data=array('status'=>$request->status,'accepted_at'=>date('Y-m-d h:i:s'));
            Order::where('id',$request->id)->update($data);

            $message = "Return request ".$status->return_number." for ".$status->product_name." has been accepted";
        }

        if ($request->status == 9) {

            $getvendordata=User::select('wallet')
            ->where('id',$status->vendor_id)
            ->first();

            if ($getvendordata->wallet >= 0) {
                $vendorwallet = $getvendordata->wallet - $status->order_total;
            } elseif ($getvendordata->wallet <= 0) {
                $vendorwallet = $getvendordata->wallet - $status->order_total;
            } else {
                $vendorwallet = 0;
            }

            $vendorwallet = User::where('id', $status->vendor_id)
            ->update(['wallet' => $vendorwallet]);

            $data=array('status'=>$request->status,'completed_at'=>date('Y-m-d h:i:s'));
            Order::where('id',$request->id)->update($data);

            $message = "Return request ".$status->return_number." for ".$status->product_name." has been Completed";

            $walletdata=User::select('wallet')->where('id',$status->user_id)->first();

            if ($walletdata->wallet >= 0) {
                $walletamount = $walletdata->wallet + $status->order_total;
            } elseif ($walletdata->wallet <= 0) {
                $walletamount = $walletdata->wallet + $status->order_total;
            } else {
                $walletamount = 0;
            }

            $UpdateWalletDetails = User::where('id', $status->user_id)
            ->update(['wallet' => $walletamount]);

            $Wallet = new Transaction;
            $Wallet->user_id = $status->user_id;
            $Wallet->order_id = $request->id;
            $Wallet->order_number = $status->order_number;
            $Wallet->wallet = $status->order_total;
            $Wallet->payment_id = $status->payment_id;
            $Wallet->transaction_type = '5';
            $Wallet->save();

            
        }

        if ($request->status == 10) {
            $data=array('status'=>$request->status,'vendor_comment'=>$request->vendor_comment,'rejected_at'=>date('Y-m-d h:i:s'));
            Order::where('id',$request->id)->update($data);

            $message = "Return request ".$status->return_number." for ".$status->product_name." has been rejected";
        }

        if ($data) {
            if ($request->status != 7) {
                $notification=array('user_id'=>$status->user_id,'order_id'=>$request->id,'return_number'=>$status->return_number,'order_status'=>$request->status,'message'=>$message,'is_read'=>"1",'type'=>"order");
                $store=Notification::create($notification);
            }
            return 1000;
        } else {
            return 2000;
        }      
    }
}
