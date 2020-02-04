<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class LappdlaviController extends Controller
{
    public function showPincode() {
if(Auth::user()){
    return redirect()->route('user.showHome');
    
}else {

        return view('auth.pincode');
    }
    }
    
    public function authUser(Request $request) {

        $data = $request->validate([
            'pincode' => ['min:4', 'max:4']
        ]);

        $pincode = $data['pincode'];

        if($settings = Setting::where('pinCode', $pincode)->first()) {
            if($user = $settings->user) {
                Auth::login($user);
                return $user;
            }

        }
        return redirect()->route('listes.showHome');
    }
}
