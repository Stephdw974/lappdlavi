<?php

namespace App\Http\Controllers;

use App\TcCompte;
use App\TcPartage;
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
        // dd($TcCompte->partages()->get());
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


    public function showPartage(TcCompte $TcCompte, TcPartage $TcPartage)
    {
        return view('tricount.showPartage', compact('TcCompte', 'TcPartage'));
    }

    public function deleteCompte(TcCompte $TcCompte)
    {
        $TcCompte->delete();
        return redirect()->route('tricount.showHome');
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

        $TcCompte->partages()->create($data);

        return redirect()->route('tricount.showCompte', $TcCompte->id);
    }

    public function showStats(TcCompte $TcCompte)
    {
        $stats = [
            ['Stephane' => ['Payed' => 0, 'Owed' => 0]],
            ['Elise' => ['Payed' => 0, 'Owed' => 0]],
        ];

        foreach(explode(',', str_replace(', ', ',', $TcCompte->members)) as $member) {
            // $stats
        }

        dd($stats);
    }
}
