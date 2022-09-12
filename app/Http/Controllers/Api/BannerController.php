<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Slider;

class BannerController extends Controller
{
    public function banner(Request $request)
    {
        $banners=Banner::select('banners.id','banners.type','banners.cat_id','banners.product_id','banners.positions',\DB::raw("CONCAT('".url('/storage/app/public/images/banner/')."/', banners.image) AS image"),'categories.category_name')
        ->leftJoin('categories', 'banners.cat_id', '=', 'categories.id')
        ->get();

        $sliders=Slider::select('link',\DB::raw("CONCAT('".url('/storage/app/public/images/slider/')."/', image) AS image_url"))
        ->where('status','1')
        ->get();

        foreach ($banners as $value) {
            if ($value['positions'] == "top") {
                $topbanner[] = array(
                    'type' => $value['type'], 
                    'image_url' => $value['image'],
                    'cat_id' => $value['cat_id'],
                    'category_name' => $value['category_name'],
                    'product_id' => $value['product_id'],
                );
            }

            if ($value['positions'] == "large") {
                $largebanner[] = array(
                    'type' => $value['type'], 
                    'image_url' => $value['image'],
                    'cat_id' => $value['cat_id'],
                    'category_name' => $value['category_name'],
                    'product_id' => $value['product_id'],
                );
            }

            if ($value['positions'] == "left") {
                $leftbanner[] = array(
                    'type' => $value['type'], 
                    'image_url' => $value['image'],
                    'cat_id' => $value['cat_id'],
                    'category_name' => $value['category_name'],
                    'product_id' => $value['product_id'],
                );
            }

            if ($value['positions'] == "bottom") {
                $bottombanner[] = array(
                    'type' => $value['type'], 
                    'image_url' => $value['image'],
                    'cat_id' => $value['cat_id'],
                    'category_name' => $value['category_name'],
                    'product_id' => $value['product_id'],
                );
            }

            if ($value['positions'] == "popup") {
                $popupbanner[] = array(
                    'type' => $value['type'], 
                    'image_url' => $value['image'],
                    'cat_id' => $value['cat_id'],
                    'category_name' => $value['category_name'],
                    'product_id' => $value['product_id'],
                );
            }
        }

        return response()->json(['status'=>1,'message'=>'Success','topbanner'=>@$topbanner,'largebanner'=>@$largebanner,'leftbanner'=>@$leftbanner,'bottombanner'=>@$bottombanner,'popupbanner'=>@$popupbanner,'sliders'=>@$sliders],200);
    }
}
