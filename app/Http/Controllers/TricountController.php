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
        $stats = [];
        $memberCount = count(explode(',', str_replace(', ', ',', $TcCompte->members)));
        $statAmount = $TcCompte->partages()->whereRaw('payedFor != payedBy')->sum('amount');
        // Initialisation du tableau
        foreach (explode(',', str_replace(', ', ',', $TcCompte->members)) as $member) {
            array_push($stats, ["Name" => $member, "Payed" => 0, "Owed" => 0]);
        }

        // Remplissage du tableau Payed
        foreach (explode(',', str_replace(', ', ',', $TcCompte->members)) as $member) {
            $payed = $TcCompte->partages()->whereRaw('payedFor != payedBy')->where([['payedBy', $member], ['payedFor', '!=', $member]])->sum('amount');

            for ($i = 0; $i < count($stats); $i++) {
                if ($stats[$i]['Name'] == $member) {
                    $stats[$i]['Payed'] = round($payed, 2, PHP_ROUND_HALF_UP);
                }
            }
        }

        // Remplissage du tableau Owed
        foreach (explode(',', str_replace(', ', ',', $TcCompte->members)) as $member) {
            $owed = $TcCompte->partages()->whereRaw('payedFor != payedBy')->where([['payedFor', 'like', '%' . $member . '%']])->sum('amount');

            for ($i = 0; $i < count($stats); $i++) {
                if ($stats[$i]['Name'] == $member) {
                    $stats[$i]['Owed'] =  round($stats[$i]['Payed'] - ($statAmount / $memberCount), 2, PHP_ROUND_HALF_UP);
                }
            }
        }


        return view('tricount.showCompte', compact('TcCompte', 'stats'));
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
        $TcCompte->partages()->delete();
        $TcCompte->delete();
        return redirect()->route('tricount.showHome');
    }

    public function deletePartage(TcCompte $TcCompte, TcPartage $TcPartage)
    {
        $TcPartage->delete();
        return redirect()->route('tricount.showCompte', $TcCompte->id);
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
        $stats = [];
        $memberCount = count(explode(',', str_replace(', ', ',', $TcCompte->members)));
        $statAmount = $TcCompte->partages()->whereRaw('payedFor != payedBy')->sum('amount');
        // Initialisation du tableau
        foreach (explode(',', str_replace(', ', ',', $TcCompte->members)) as $member) {
            array_push($stats, ["Name" => $member, "Payed" => 0, "Owed" => 0]);
        }

        // Remplissage du tableau Payed
        foreach (explode(',', str_replace(', ', ',', $TcCompte->members)) as $member) {
            $payed = $TcCompte->partages()->whereRaw('payedFor != payedBy')->where([['payedBy', $member], ['payedFor', '!=', $member]])->sum('amount');

            for ($i = 0; $i < count($stats); $i++) {
                if ($stats[$i]['Name'] == $member) {
                    $stats[$i]['Payed'] = $payed;
                }
            }
        }

        // Remplissage du tableau Owed
        foreach (explode(',', str_replace(', ', ',', $TcCompte->members)) as $member) {
            $owed = $TcCompte->partages()->whereRaw('payedFor != payedBy')->where([['payedFor', 'like', '%' . $member . '%']])->sum('amount');

            for ($i = 0; $i < count($stats); $i++) {
                if ($stats[$i]['Name'] == $member) {
                    $stats[$i]['Owed'] =  $stats[$i]['Payed'] - ($statAmount / $memberCount);
                }
            }
        }

        dd($stats);
    }
}
