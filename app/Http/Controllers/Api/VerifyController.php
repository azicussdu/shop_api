<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class VerifyController extends Controller
{
    public function verifyEmail($token = null)
    {
        if($token == null) {

            session()->flash('message', 'Invalid Login attempt');

            //return redirect()->route('login');
            return response()->json('message', 'Invalid Login attempt');
        }

        $user = User::firstWhere('email_verification_token',$token);

        if($user == null ){

            session()->flash('message', 'Invalid Login attempt');

            //return redirect()->route('login');
            return response()->json('message', 'Invalid Login attempt');

        }

        $user->update([

            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => ''

        ]);

        session()->flash('message', 'Your account is activated, you can log in now');

        //return response()->json(['message'=>'Successfully verified']);
        return redirect()->away("http://localhost:8080");

    }
    public function resetPassword($token = null){
        if($token == null) {

            session()->flash('message', 'Invalid Login attempt');

            //return redirect()->route('login');
            return response()->json('message', 'Invalid Login attempt');
        }

        $user = User::firstWhere('reset_password_token',$token);

        if($user == null ){

            session()->flash('message', 'Invalid Login attempt');

            //return redirect()->route('login');
            return response()->json('message', 'Invalid Login attempt');

        }
        $user->update([
            'ready_to_reset'=>1,
            'reset_password_token' => ''

        ]);
        return redirect()->away("http://localhost:8080");
    }
}
