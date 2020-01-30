<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class LappdlaviController extends Controller
{
    public function showPincode() {
        return view('auth.pincode');
    }

    public function authUser(Request $request) {

        $data = $request->validate([
            'pincode' => ['min:4', 'max:4']
        ]);

        $pincode = $data['pincode'];

        if($pincode == '1218') {
            $u = User::find(2);
            Auth::login($u);
        } else if($pincode == '0412'){
            $u = User::find(1);
            Auth::login($u);
        }

        return redirect()->route('listes.showHome');
    }
}
