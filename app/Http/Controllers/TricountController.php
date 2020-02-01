<?php

namespace App\Http\Controllers;

use App\TcCompte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TricountController extends Controller
{
    public function showHome()
    {
        $comptes = TcCompte::all();
        return view('tricount.showHome', compact('comptes'));
    }


    public function showCompte(TcCompte $TcCompte)
    {
        return view('tricount.showCompte', compact('TcCompte'));
    }


    public function showCompteCreation()
    {
        return view('tricount.showCompteCreation');
    }


    public function showPartageCreation(TcCompte $TcCompte)
    {
        return view('tricount.showPartageCreation', compact('TcCompte'));
    }


    public function showPartage()
    {
        return view('tricount.showPartage');
    }

    public function createCompte(Request $request)
    {

        $data = $request->validate([
            'name' => ['required'],
            'members' => ['required']
        ]);

        $u = Auth::user();
        $u->comptes()->create($data);

        return redirect()->route('tricount.showHome');
    }


    public function createPartage(Request $request, TcCompte $TcCompte)
    {
        $data = $request->validate([
            'name' => ['required'],
            'amount' => ['required'],
            'payedBy' => ['required'],
            'payedFor' => ['required'],
        ]);

        $u = Auth::user();
        $u->comptes()->create($data);

        return redirect()->route('tricount.showHome');
    }
}
