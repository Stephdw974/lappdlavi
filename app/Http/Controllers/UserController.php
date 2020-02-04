<?php

namespace App\Http\Controllers;

use App\Background;
use App\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth');        
    }

    public function showHome() {
        return view('user.home');
    }

    public function changeBackground(Request $request){
        $user = Auth::user();
        $userSettings = Setting::firstOrCreate(['user_id' => $user->id]);

        $data = $request->validate([
            'backgroundImage' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $data['backgroundImage'] = (String) Str::uuid() . '.' . $request->backgroundImage->getClientOriginalExtension();

        $User = Auth::user();
        $request->backgroundImage->move(public_path('backgrounds'), $data['backgroundImage']);

        $userSettings->backgroundImage = $data['backgroundImage'];
        $userSettings->save();
        
        return redirect()->route('user.showHome');
    }


    public function changeColor(Request $request){
        $user = Auth::user();
        $userSettings = Setting::firstOrCreate(['user_id' => $user->id]);

        $data = $request->validate([
            'mainColor' => ['required'],
        ]);
        
        $userSettings->mainColor = $data['mainColor'];
        $userSettings->save();
        
        return redirect()->route('user.showHome');
    }
    
    public function changePincode(Request $request){
        $user = Auth::user();
        $userSettings = Setting::firstOrCreate(['user_id' => $user->id]);

        $data = $request->validate([
            'pinCode' => ['required'],
        ]);

        $userSettings->pinCode = $data['pinCode'];
        $userSettings->save();
        
        return redirect()->route('user.showHome');
    }
    
}

