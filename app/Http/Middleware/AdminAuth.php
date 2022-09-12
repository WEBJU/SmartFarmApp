<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\User;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(Auth::user()){
            if(isset(Auth::user()->roles->pluck('name')[0])){                
                if(Auth::user()->roles->pluck('name')[0]=="super-admin" OR Auth::user()->roles->pluck('name')[0]=="admin"){

                    if(Auth::user()->is_verified == '1') {
                        return $next($request);
                    } else {
                        $otp = rand ( 100000 , 999999 );
                        try{

                            $title="Email Verification";
                            $email=Auth::user()->email;
                            $data=['title'=>$title,'email'=>$email,'otp'=>$otp];

                            Mail::send('Email.emailverification',$data,function($message)use($data){
                                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                                $message->to($data['email']);
                            } );

                            $update=User::where('email',Auth::user()->email)->update(['otp'=>$otp,'is_verified'=>'2']);

                            if (env('Environment') == 'sendbox') {
                                session ( [
                                    'email' => Auth::user()->email,
                                    'password' => Auth::user()->password,
                                    'otp' => $otp,
                                ] );
                            } else {
                                session ( [
                                    'email' => Auth::user()->email,
                                ] );
                            }

                        }catch(\Swift_TransportException $e){
                            $response = $e->getMessage() ;
                            return Redirect::back()->with('danger', "Something went wrong");
                        }
                        return Redirect::to('/admin/otp-verify')->with('success', "Email has been sent");
                    }                   
                }
            }
        }
        Auth::logout();
        return redirect(route('admin.login'));
    }
}
