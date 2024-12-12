<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ResetPasswordModel;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedUserController extends Controller
{

    public function AuthenticatedUserController(){
        $role = Auth::user()->user_type;

        switch ($role) {
          case 'Super Admin':
             return redirect()->route('super-admin.dashboard');
             break;

          case 'Staff':
            return redirect()->route('staff.dashboard');
             break;

            case 'Manager':
            return redirect()->route('manager.dashboard');
                break;
        }
    }

    public function darkmode(){
        if(Auth::user()->dark_mode==true){
            Auth::user()->update(['dark_mode' => false]);
        }else{
            Auth::user()->update(['dark_mode' => true]);
        }
    }

    public function logOutUser(){
        if(Auth::user()!=null){
            Session::flush();

            //checked the type of user login out and redirect
            return redirect()->route('welcome');
        }else{
            return redirect()->route('welcome');
        }

    }

    public function setpassword($email, $token){
        $checkToken = ResetPasswordModel::where('email',$email)->first();
        return view('auth.reset-password',compact('checkToken'));
    }

    //verify account and set password
    public function changePassword(Request $request){
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8','same:password'],
        ]);


        User::where('email',$request->email)->first()->update([
            'password' => Hash::make($data['password']),
            'email_verified_at' => now(),
            'status' => 'Active',
        ]);

        //delete verificaiton token
        ResetPasswordModel::where('email',$request->email)->delete();

        return redirect()->route('login')->with('feedback','Verification successful! Please login to continue.');
    }//end verify account


    public function forgetpassword(Request $request){
        $data = $request->validate([
            'email' => ['email','required']
        ]);

        $checkMail =  User::where(['email'=>$data['email'],'status'=>'Active'])->first();

        if($checkMail!=null){
            ResetPasswordModel::where('email',$data['email'])->delete();
            $otp_code = ResetPasswordModel::create([
                'email' => $checkMail->email,
                'token' => $token = Str::random(60),
                // 'otp' => $otp = mt_rand(2,1000000),
            ]);

            $url = url('set-password/'.$checkMail->email.'/'.$token);
<<<<<<< Updated upstream
            // try{
                Mail::to($checkMail)->send(new ResetPasswordMail($checkMail,$url));
            // }catch (\Exception $e) { }
=======
            //try{
                Mail::to($checkMail)->send(new ResetPasswordMail($checkMail,$url));
           // }catch (\Exception $e) { }
>>>>>>> Stashed changes

            return back()->with('feedback','Password successfully resset, a reset link has been sent to your register mail');
        }else{
            return back()->with('errorfeedback','Sorry this email is either incorrect or your accountis disabled, kindly contact support for assistance');
        }
    }
}
