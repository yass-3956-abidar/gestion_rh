<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Employer;
use App\Charts\EmployerDepartement;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $devise = DB::table('societes')->where('user_id', Auth::user()->id)->value('devise');
        $employers = DB::table('employers')->where('societe_id', $idsociete)->where('deleted_at', null)->get();
        $nombre_employer = count($employers);
        $presence = [];
        $departemnt = [];
        $emploi = [];
        $bulletinPaie = [];
        $cmp = 0;
        $cmpPaie = 0;
        $cmpPost = 0;
        foreach ($employers as $employer) {
            $employer = Employer::find($employer->id);
            $bulletinPaie[$employer->id] = $employer->bulletinpaies;
            if (!in_array($employer->emploi_id, $emploi)) {
                array_push($emploi, $employer->emploi_id);
            }
            if (!in_array($employer->departement_id, $departemnt)) {
                array_push($departemnt, $employer->departement_id);
            }
            $presence[$employer->id] = DB::table('presences')->where('employer_id', $employer->id)
                ->where('date_pointe', '=', '2020-06-04')->first();
            if ($presence[$employer->id] != null) {
                $cmp++;
            }
            $bulletinPaie[$employer->id] = DB::table('bulletin_paies')->where('employer_id', $employer->id)
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('yy'))->get();
            if (count($bulletinPaie[$employer->id]) > 0) {
                $cmpPaie++;
            }
        }



        $nbrdep = count($departemnt);
        $nbrFichePaie = count($bulletinPaie);
        $nbremploi = count($emploi);
        return view('home')->with([
            'nombre_employer' => $nombre_employer,
            'employer_preson' => $cmp,
            'nbrdep' => $nbrdep,
            'nbremploi' => $nbremploi,
            'nbrFichePaie' => $cmpPaie,
        ]);
        // nombre d'employer de cette entreprise;

    }
    public function registration()
    {
        Alert::success('Bienvenu Dans Votre APP@RH');
        return view('auth.registration');
    }
}
