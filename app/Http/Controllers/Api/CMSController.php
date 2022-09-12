<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\About;
use App\Models\TermsConditions;

class CMSController extends Controller
{
    public function index(Request $request)
    {
        $privacypolicy=PrivacyPolicy::select('privacypolicy_content')->first();

        $about=About::select('about_content')->first();

        $termsconditions=TermsConditions::select('terms_conditions')->first();

        return response()->json(['status'=>1,'message'=>'Success','privacypolicy'=>$privacypolicy->privacypolicy_content,'about'=>$about->about_content,'termsconditions'=>$termsconditions->terms_conditions],200);
    }
}
