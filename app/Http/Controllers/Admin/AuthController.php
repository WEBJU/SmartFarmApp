<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Auth;
use Hash;
use Session;
use DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::user()){
            return redirect()->route('admin.home');
        }
        return view('Admin.auth.login');
    }

    public function doLogin(Request $request)
    {
        try{
            
                    $this->validate($request,[
                        'email' => 'required|email',
                        'password' => 'required|min:6',
                    ]);

                    $auth=Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                    if ($auth) {
                        if(isset(Auth::user()->roles->pluck('name')[0])){
                            if(Auth::user()->roles->pluck('name')[0]=="super-admin" OR Auth::user()->roles->pluck('name')[0]=="admin"){
                                return redirect(route('admin.home'));
                            }
                        }
                        
                    }
                    return redirect()->back()->with('error', 'Oops! Invalid Login Details');
               
                 
        }catch(Exception $exception){
            return back()->withError($exception->getMessage())->withInput();    
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('admin.login'));
    }

    public function profile(Request $request)
    {
        
    }

    public function changePassword(Request $request)
    {
    
    }

   

    public function otp_verification(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'otp' => 'required'
        ]);

        $checkuser=User::where('email',$request->email)->first();

        if (!empty($checkuser)) {
            if ($checkuser->otp == $request->otp) {

                $update=User::where('email',$request['email'])->update(['otp'=>NULL,'is_verified'=>'1']);

                if ($checkuser->type == 3) {
                    return Redirect::to('/admin');
                }                

                if ($checkuser->type == 2) {
                    $cart=Cart::where('user_id',$checkuser->id)->count();

                    Auth::login($checkuser);
                    
                    Storage::disk('local')->put("cart", $cart);

                    return Redirect::to('/');
                }
                
            } else {
                return Redirect::back()->with('danger', "Invalid OTP");
            }  
        } else {
            return Redirect::back()->with('danger', "Invalid email");
        }   
    }
}
