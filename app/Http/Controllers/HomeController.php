<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Employer;
use App\Charts\EmployerDepartement;
use App\Departement;
use App\Emploi;

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
        foreach ($employers as  $employer) {
            $employer = Employer::find($employer->id);
            $bulletinPaie[$employer->id] = $employer->bulletinpaies;
            if (!in_array($employer->emploi_id, $emploi)) {
                array_push($emploi, $employer->emploi_id);
            }
            if (!in_array($employer->departement_id, $departemnt)) {
                array_push($departemnt, $employer->departement_id);
            }
            $presence[$employer->id] = DB::table('presences')->where('employer_id', $employer->id)
                ->whereMonth('created_at', date('m'))
                ->whereDay('created_at', date('d'))
                ->whereYear('created_at', date('yy'))->first();
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
        $nbremploi = count($emploi);
        // dd($emploi);
        $emploieEmploye = [];
        foreach ($emploi as $emp) {
            $emploi = Emploi::find($emp);
            $emploieEmploye[] = [$emploi, $emploi->employers];
        }
        // dd($emploieEmploye);
        $employerDepartement = [];
        foreach ($departemnt as $depa) {
            $departement = Departement::find($depa);
            $employerDepartement[] = [$departement, $departement->employers];
        }
        $nbrdep = count($departemnt);
        // dd($departemnt);
        // $departement = Departement::find($departemnt[0]);
        // dd($employerDepartement);
        // dd($emploieEmploye);
        return view('home')->with([
            'nombre_employer' => $nombre_employer,
            'employer_preson' => $cmp,
            'nbrdep' => $nbrdep,
            'nbremploi' => $nbremploi,
            'nbrFichePaie' => $cmpPaie,
            'employerDepartement' => $employerDepartement,
            'emploieEmploye' => $emploieEmploye,
        ]);
        // nombre d'employer de cette entreprise;

    }
    public function registration()
    {
        Alert::success('Bienvenu Dans Votre APP@RH');
        return view('auth.registration');
    }
}
