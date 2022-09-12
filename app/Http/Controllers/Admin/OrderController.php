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

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->roles->first()->name == "super-admin") {
            $data=Order::with(['vendors'])->select('order_number','vendor_id','order_notes','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('SUM(order_total) AS grand_total'),\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('count(order_number) AS no_products'))
            ->groupBy('order_number')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        } 
        if(Auth::user()->roles->first()->name == "admin") {
            $data=Order::with(['vendors'])->select('order_number','vendor_id','order_notes','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('SUM(order_total) AS grand_total'),\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('count(order_number) AS no_products'))
            ->where('vendor_id',Auth::user()->id)
            ->groupBy('order_number')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        }
        return view('Admin.orders.index',compact('data'));
    }

    public function search(Request $request)
    {
        if(Auth::user()->roles->first()->name == "super-admin") {
            $data=Order::with(['vendors'])->select('order_number','vendor_id','order_notes','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('SUM(order_total) AS grand_total'),\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('count(order_number) AS no_products'))
            ->groupBy('order_number')
            ->where('order_number', 'LIKE', '%' . $request->search . '%')
            ->orWhere('full_name', 'LIKE', '%' . $request->search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        } 
        if(Auth::user()->roles->first()->name == "admin") {
            $data=Order::with(['vendors'])->select('order_number','vendor_id','order_notes','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('SUM(order_total) AS grand_total'),\DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'),\DB::raw('count(order_number) AS no_products'))
            ->where('vendor_id',Auth::user()->id)
            ->where('order_number', 'LIKE', '%' . $request->search . '%')
            ->orWhere('full_name', 'LIKE', '%' . $request->search . '%')
            ->groupBy('order_number')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        }
        return view('Admin.orders.index',compact('data'));

    }

    public function orderdetails($id)
    {
        $order_info=Order::with(['vendors'])->select('vendor_id','order_number','order_notes','payment_type','payment_id','full_name','email','mobile','landmark','street_address','pincode','status',\DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as date'),\DB::raw('SUM(price*qty) AS subtotal'),\DB::raw('SUM(tax) AS tax'),\DB::raw('SUM(shipping_cost) AS shipping_cost'),\DB::raw('SUM(order_total) AS grand_total'))
        ->where('order_number',$id)
        ->groupBy('order_number')
        ->orderBy('id', 'DESC')
        ->first();

        $order_data=Order::select('id','product_id','product_name','price','qty','tax','status','discount_amount','order_total',\DB::raw('(case when variation is null then "" else variation end) as variation'),\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"),'shipping_cost')
        ->where('order_number',$id)
        ->orderBy('id', 'DESC')
        ->get();

        return view('Admin.orders.order-details',compact('order_info','order_data'));
    }

    public function delete()
    {
        $data=Order::where('vendor_id',Auth::user()->id)->get();
        return view('Admin.orders.index',compact('data'));
    }

    public function changeStatus(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'status' => 'required',
        ]);

        $status=Order::select('order_total','product_name','payment_id','user_id','vendor_id','payment_type','order_number')
        ->where('id',$request->id)
        ->first();

        if ($request->status == 1) {
            $data=array('status'=>$request->status,'cancelled_at'=>date('Y-m-d h:i:s'));
            Order::where('id',$request->id)->update($data);

            $message = "Order ".$order_number." has been placed";
        }

        if ($request->status == 2) {
            $data=array('status'=>$request->status,'confirmed_at'=>date('Y-m-d h:i:s'));
            Order::where('id',$request->id)->update($data);

            $message = "".$status->product_name." has been confirmed";
        }

        if ($request->status == 3) {
            $data=array('status'=>$request->status,'shipped_at'=>date('Y-m-d h:i:s'));
            Order::where('id',$request->id)->update($data);

            $message = "".$status->product_name." has been shipped";
        }

        if ($request->status == 4) {
            $data=array('status'=>$request->status,'delivered_at'=>date('Y-m-d h:i:s'));
            Order::where('id',$request->id)->update($data);

            $message = "".$status->product_name." has been delivered";

            if ($status->payment_type == 1) {
                $getvendordata=User::select('wallet')
                ->where('id',$status->vendor_id)
                ->first();
                if ($getvendordata->wallet > 0) {
                    $vendorwallet = $getvendordata->wallet + $status->order_total;
                } elseif ($getvendordata->wallet < 0) {
                    $vendorwallet = $getvendordata->wallet + $status->order_total;
                } else {
                    $vendorwallet = 0;
                }
                $UpdateWalletDetails = User::where('id', $status->vendor_id)
                ->update(['wallet' => $vendorwallet]);
            }
        }


        if ($request->status == 5) {

            if ($status->payment_type != "1") {
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
                $Wallet->transaction_type = '1';
                $Wallet->save();


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
            }
            
            $data=array('status'=>$request->status,'cancelled_at'=>date('Y-m-d h:i:s'));
            Order::where('id',$request->id)->update($data);
            $message = "".$status->product_name." has been cancelled by vendor";
        }

        if ($data) {

            $notification=array('user_id'=>$status->user_id,'order_id'=>$request->id,'order_number'=>$status->order_number,'order_status'=>$request->status,'message'=>$message,'is_read'=>"1",'type'=>"order");
            $store=Notification::create($notification);

            return 1000;
        } else {
            return 2000;
        }      
    }
}
