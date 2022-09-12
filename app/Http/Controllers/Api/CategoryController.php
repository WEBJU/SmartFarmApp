<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Innersubcategory;
use Validator;

class CategoryController extends Controller
{
    public function category(Request $request)
    {
    	$categorydata=Category::select('id','category_name',\DB::raw("CONCAT('".url('/storage/app/public/images/category/')."/', icon) AS image_url"))
        ->where('status','=','1')
        ->get();
        if(!empty($categorydata))
        {
        	return response()->json(['status'=>1,'message'=>'Success','data'=>$categorydata],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }

    public function subcategory(Request $request)
    {
    	$subcategorydata=Subcategory::select('id','subcategory_name')
        ->where('cat_id',$request->cat_id)
        ->where('status','1')
        ->get();

        $subcategory = array();
        foreach ($subcategorydata as $ckey => $value) {

            $innersubcategorydata=Innersubcategory::select('id','subcat_id','innersubcategory_name')
            ->where('subcat_id',$value['id'])
            ->where('status','1')
            ->get();

            $innersubcategory = array();
            foreach ($innersubcategorydata as $key => $addonsvalue) {
                if($addonsvalue->subcat_id==$value->id){
                    $innersubcategory[] =array('id'=> $addonsvalue->id,'innersubcategory_name'=> $addonsvalue->innersubcategory_name) ;
                }
            }

            $subcategory[$ckey]['subcat_id'] =$value['id'];
            $subcategory[$ckey]['subcategory_name'] =$value['subcategory_name'];
            $subcategory[$ckey]['innersubcategory'] =$innersubcategory;
        }

        $data = array(
            'subcategory' => @$subcategory,
        ); 
        if(!empty($data))
        {
        	return response()->json(['status'=>1,'message'=>'Success','data'=>$data],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>trans('messages.no_data')],200);
        }
    }
}
