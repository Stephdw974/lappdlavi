<?php

namespace App\Http\Controllers;

use App\Background;
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
            $data = $request->validate([
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            ]);
    
            $data['image'] = (String) Str::uuid() . '.' . $request->image->getClientOriginalExtension();
    
            $User = Auth::user();
            $request->image->move(public_path('backgrounds'), $data['image']);

            $User->backgrounds()->create($data);
            return redirect()->route('user.showHome');
    }
}
