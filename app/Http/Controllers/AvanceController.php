<?php

namespace App\Http\Controllers;

use App\Avance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Services\AvanceService;
use App\Http\Requests\AvanceRequest;
use App\Employer;

class AvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $post->created_at->diffForHumans()
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $devise = DB::table('societes')->where('user_id', Auth::user()->id)->value('devise');
        $employers = DB::table('employers')->where('societe_id', $idsociete)->where('deleted_at', null)->get();
        // dd($employers);
        $avances = [];
        foreach ($employers as $employer) {
            $avances[$employer->id] = DB::table('avances')
                ->where('employer_id', $employer->id)
                ->whereYear('created_at', date('yy'))
                ->whereMonth('created_at', date('m'))->get();
        }

        // dd(date('m'));
        // dd($avances);
        return view('avance.index')
            ->with('employers', $employers)
            ->with('devise', $devise)
            ->with('avances', $avances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employers = Employer::all();
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $devise = DB::table('societes')->where('user_id', Auth::user()->id)->value('devise');
        $employesNonTrahed = [];
        foreach ($employers as $employer) {
            if ($employer->deleted_at == null && $employer->societe_id == $idsociete) {
                array_push($employesNonTrahed, $employer);
            }
        }
        $employers = $employesNonTrahed;
        foreach ($employers as $employer) {
            $employer->setAttribute('avance', $employer->avances);
            $total = AvanceService::calculTotalAvane($employer->avances);
            $employer->setAttribute('total', $total);
        }
        return view('avance.show')->with('employers', $employers)
            ->with('devise', $devise);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // creation de l'avance de mois courant si il n'esxiste pas
        $avance = Db::table('avances')->where('employer_id', $request->employer_id)
            ->whereYear('created_at', date('yy'))
            ->whereMonth('created_at', date('m'))->get();
        $employer = Employer::find($request->employer_id);
        if (count($avance) == 0) {
            $avance = new Avance();
            $avance->date_affectation = $request->date_affectation;
            $avance->montant = $request->montant;
            $avance->employer_id = $request->employer_id;
            $avance->save();
            return response()->json([
                'status' => true,
                'message' => 'Avance cree avec sucees'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Une Avance est deja cree ce mois pour l\'employer',
                'nom' => $employer->nom_employer,
                'prenom' => $employer->prenom,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Avance  $avance
     * @return \Illuminate\Http\Response
     */
    public function show(Avance $avance)
    {

        return view('avance.show')->with('avance', $avance);
    }
    public function historique()
    {
        //
        $employers = Employer::all();
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $devise = DB::table('societes')->where('user_id', Auth::user()->id)->value('devise');
        $employesNonTrahed = [];
        foreach ($employers as $employer) {
            if ($employer->deleted_at == null && $employer->societe_id == $idsociete) {
                array_push($employesNonTrahed, $employer);
            }
        }
        $employers = $employesNonTrahed;
        foreach ($employers as $employer) {
            $employer->setAttribute('avance', $employer->avances);
            $total = AvanceService::calculTotalAvane($employer->avances);
            $employer->setAttribute('total', $total);
        }
        return view('avance.show')->with('employers', $employers)
            ->with('devise', $devise);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Avance  $avance
     * @return \Illuminate\Http\Response
     */
    public function edit(Avance $avance)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Avance  $avance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $avance = Avance::find($request->id_avance);
        $avance->montant = $request->montant;
        $avance->date_affectation = $request->date_affectation;
        $avance->update();
        return response()->json([
            'status' => true,
            'message' => 'avance mis à jour avec succès',
            'montant' => $request->montant
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Avance  $avance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avance $avance)
    {
        dd($avance);
    }
}
