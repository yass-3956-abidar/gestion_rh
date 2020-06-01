<?php

namespace App\Http\Controllers;

use App\BulletinPaie;
use App\Employer;
use App\Prime;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Json;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\BulletinService;

class PaieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paie = [];
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        // $devise = DB::table('societes')->where('user_id', Auth::user()->id)->value('devise');
        $employers = DB::table('employers')->where('societe_id', $idsociete)->where('deleted_at', null)->get();
        foreach ($employers as $employer) {
            $paie[$employer->id] = Employer::find($employer->id)->bulletinPaies;
        }
        return view('paie.index')->with('employers', $employers)->with('paie', $paie);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $employers = DB::table('employers')->where('societe_id', $idsociete)->where('deleted_at', null)->get();
        $contrat = [];
        foreach ($employers as $employer) {
            $contrat[$employer->id] = DB::table('contrats')->where('employer_id', $employer->id);
        }
        return view('paie.create')->with('employers', $employers)
            ->with('contrat', $contrat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $employer = Employer::find($request->id);
        $contrat = DB::table('contrats')->where('employer_id', '=', $employer->id)->first();
        $post = DB::table('emplois')->where('id', $employer->emploi_id)->first();
        $avance = Db::table('avances')->where('employer_id', $employer->id)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('yy'))->first();
        // return response()->json($employer);
        return response()->json([
            'employer' => $employer,
            'contrat' => $contrat,
            'post' => $post,
            'avance' => $avance,
        ]);
    }

    /**
     * @param  int  $nbrHeur
     *@param  string  $nbrHeur
     *@param  double  $cout
     *
     */

    public function getsalaireNet(Request $request)
    {

        $j = $request->nbr_prime_impo;// designImpo //MontantImpo

        for ($k = 1; $k <= $j; $k++) {
            $prime = new Prime();
            $prime->designation = $request->input('designImpo' . $k);
            $prime->montant_prim = $request->input('MontantImpo' . $k);
            $prime->type = 'inconu';
            $prime->employer_id = $request->employer_id;
            $prime->save();
        };

        // calcul total primes
        $totalPrime = 0;
        for ($k = 1; $k <= $j; $k++) {
            $totalPrime += $request->input('MontantImpo' . $k);
        }
        // total heur supp;
        $totalHeurSup = BulletinService::getHeurSuppFerier($request->nbr_heur_ferie, $request->interval_Ferier, $request->cout_heurSup)
            +
            BulletinService::getHeurSuppOuvra($request->nbr_heur_ouvrable, $request->interval_ouvrable, $request->cout_heurSup);
        $primes = Employer::find($request->employer_id)->primes;
        /// calcul ancienter
        $durreAnciente = BulletinService::calculDuree($request->date_embauche);
        $tauxAncienter = BulletinService::getTaux($durreAnciente);
        $Primeancienter = BulletinService::calculAncienter($request->date_embauche, $request->salaire_base, $totalHeurSup);
        // calcul salaire brute global
        $sbg = $request->salaire_base + $totalHeurSup + $Primeancienter + $totalHeurSup;
        //  trouver l'avance du mois courant
        return response()->json([
            'employer_id' => $request->employer_id,
            'date_belletin_debut' => $request->date_belletin_debut,
            'date_belletin_fin' => $request->date_belletin_fin,
            'date_embauche' => $request->date_embauche,
            'salaire_base' => $request->salaire_base,
            'situationFami' => $request->situationFami,
            'nbr_enfant' => $request->nbr_enfant,
            'nbr_heur_ferie' => $request->nbr_heur_ferie,
            'interval_Ferier' => $request->interval_Ferier,
            'nbr_heur_ouvrable' => $request->nbr_heur_ouvrable,
            'interval_ouvrable' => $request->interval_ouvrable,
            'nbr_prime_impo' => $request->nbr_prime_impo,
            'primes' => $primes,
            'cout_heurSup' => $request->cout_heurSup,
            'totalHeurSup' => $totalHeurSup,
            'totalPrime' => $totalPrime,
            'Primeancienter' => $Primeancienter,
            'durreAnciente' => $durreAnciente,
            'tauxAncienter' => $tauxAncienter . "%",
            'sbg' => $sbg,
            'avance' => $request->avance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
