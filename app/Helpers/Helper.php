<?php
namespace App\Helpers;
use App\Models\Settings;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Innersubcategory;
use App\Models\Banner;
use App\Models\Help;
use App\Models\Products;
use URL;

class Helper{

    public static function CurrencyFormatter($money)
    {
        $currency=Settings::select('currency','currency_position')->first();

        if ($currency->currency_position == "left") {
            return $currency->currency . number_format($money, 2);
        }
        if ($currency->currency_position == "right") {
            return number_format($money, 2) . $currency->currency;
        }
    }

    public static function getcart($user_id)
    {

        $cart=Cart::select('id','product_id','product_name','qty','price','variation','attribute',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))
        ->where('user_id', $user_id)
        ->orderBy('id', 'DESC')
        ->get();

        return $cart;
    }

    public static function getwalletbalance($user_id)
    {

        $walletbalance=User::select('wallet')
        ->where('id', $user_id)
        ->first();
        if ($walletbalance->wallet != "") {
            $balance = $walletbalance->wallet;
        } else {
            $balance = "";
        }
        return $balance;
    }

    public static function UpdateVendorWallet($id,$vendor_id)
    {
        $status=Order::select('order_total','vendor_id')
        ->where('id',$id)
        ->first();

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

        $vendorwallet = User::where('id', $status->vendor_id)
        ->update(['wallet' => $vendorwallet]);
        
        return $vendorwallet;
    }

    public static function ReturnOrderCount($vendor_id)
    {
        $orders=Order::select('order_total','vendor_id')
        ->where('vendor_id',$vendor_id)
        ->where('status','7')
        ->count();
        
        return $orders;
    }

    public static function NewOrderCount($vendor_id)
    {
        $orders=Order::select('order_total','vendor_id')
        ->where('vendor_id',$vendor_id)
        ->where('status','1')
        ->groupBy('order_number')
        ->count();
        
        return $orders;
    }

    public static function PayoutRequest()
    {
        $payoutrequest=Payout::where('status','1')
        ->count();
        
        return $payoutrequest;
    }

    public static function MinBalanceForWithdraw($user_id)
    {

        $walletbalance=User::select('wallet')
        ->where('id', $user_id)
        ->first();
        if ($walletbalance->wallet > 0) {
            $balance = $walletbalance->wallet;
        } else {
            $balance = 0;
        }

        $minbalance=Settings::select('min_balance')->first();

        if ($balance >= $minbalance->min_balance) {
            $display = 1;
        } else {
            $display = 0;
        }

        return $display;
    }

    public static function CheckInfo($user_id)
    {

        $bankdetails=Bank::where('vendor_id', $user_id)->first();
        if (empty($bankdetails)) {
            $info = 1;
        } else {
            $info = 0;
        }

        return $info;
    }

    public static function getCategory()
    {

        $categories=Category::select('id','category_name','slug',\DB::raw("CONCAT('".url('/storage/app/public/images/category/')."/', icon) AS image"))
        ->where('status','1')
        ->get();

        return $categories;
    }

    public static function getSubcategory()
    {

        $subcategory=Subcategory::select('id','cat_id','subcategory_name','slug')
        ->where('status','1')
        ->get();

        return $subcategory;
    }

    public static function InnerSubcategory()
    {

        $innersubcategory=Innersubcategory::select('id','cat_id','subcat_id','innersubcategory_name','slug')
        ->where('status','1')
        ->get();

        return $innersubcategory;
    }

    public static function webinfo()
    {

        $webinfo=Settings::select(\DB::raw("CONCAT('".url('/storage/app/public/images/settings/')."/', logo) AS image"),\DB::raw("CONCAT('".url('/storage/app/public/images/settings/')."/', favicon) AS favicon"),'copyright','address','contact','email','site_title','meta_title','meta_description',\DB::raw("CONCAT('".url('/storage/app/public/images/settings/')."/', og_image) AS og_image"),'facebook','twitter','instagram','linkedin')
        ->first();

        return $webinfo;
    }

    public static function Help()
    {
        $help=Help::where('status','1')
        ->count();
        
        return $help;
    }

    public static function homebanner()
    {

        $banners=Banner::select('id','type','cat_id','product_id',\DB::raw("CONCAT('".url('/storage/app/public/images/banner/')."/', image) AS image"))
        ->where('positions','popup')
        ->first();

        return $banners;
    }

    public static function getSlug($type,$id)
    {
        $slug = "#";
        if ($type == 'category') {
            $data=Category::select('slug')->where('id',$id)->first();
            $slug = URL::to('categories/products/'.$data->slug);
        }
        if ($type == 'product') {
            $data=Products::select('slug')->where('id',$id)->first();
            $slug = URL::to('products/product-details/'.$data->slug);
        }
        return $slug;
    }
}