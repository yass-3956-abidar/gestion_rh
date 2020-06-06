<?php

namespace App\Http\Controllers;

use App\Conget;
use App\CongetType;
use Illuminate\Http\Request;
use App\Http\Requests\CongetRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CongetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $congetDemandes = DB::table('congets')->where('id_societe', DB::table('societes')->where('user_id', Auth::user()->id)->value('id'))->get();
        $conget = [];
        foreach ($congetDemandes as $congetDemande) {
            $congetDemande = Conget::find($congetDemande->id);
            // $congetDemande["employer"]=$congetDemande->employer;
            // $congetDemande["congetType"]=$congetDemande->congetType;
            $congetDemande->date_debut = date("d/m/yy", strtotime($congetDemande->date_debut));
            $conget[$congetDemande->id] = [$congetDemande, $congetDemande->employer, $congetDemande->congetType];
        }
        // dd($conget);
        return view('conget.congetIndex')->with('demande_congets', $conget);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('espaceEmployer.conget.create');
    }
    public function updateStatus($id)
    {
        $affected = DB::table('congets')
            ->where('id', $id)
            ->update(['status' => 'Accepter']);
        return redirect(route('conget.index'));
    }
    public function destroyStatus($id)
    {
        $affected = DB::table('congets')
            ->where('id', $id)
            ->update(['status' => 'Reféser']);
        return redirect(route('conget.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CongetRequest $request)
    {

        $conget = new Conget();
        $congetType = DB::table('conget_types')->where('type', $request->type)->first();
        $employer = DB::table('employers')->where('cin', $request->input('employer_id'))->first();
        $idContraType = 0;
        if ($congetType == null) {
            CongetType::create([
                'type' => $request->input('type'),
            ]);
            $idContraType = DB::table('conget_types')->max('id');
        } else {
            $idContraType = $congetType->id;
        }
        $conget->date_debut = $request->input('date_debut');
        $conget->durre = $request->input('durre');
        $conget->employer_id = $employer->id;
        $conget->id_societe = $employer->societe_id;
        $conget->conget_type_id = $idContraType;
        $conget->save();
        $request->session()->flash('success', 'Votre demande Est Envoyer avec succé');
        toast(session('success'), 'success');
        return redirect(route('espaceEmployer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conget  $conget
     * @return \Illuminate\Http\Response
     */
    public function show(Conget $conget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conget  $conget
     * @return \Illuminate\Http\Response
     */
    public function edit(Conget $conget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conget  $conget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $affected = DB::table('congets')
        //     ->where('id', $conget->id)
        //     ->update(['date_debut' => $request->request, 'durre' => $request->durre]);
        $conget = Conget::find($id);
        $conget->date_debut = $request->date_debut;
        $conget->durre = $request->durre;
        $conget->update();
        return response()->json([
            'status' => true,
            'message'=>'conget modifier avec succeé'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conget  $conget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conget $conget)
    {
        //
    }
}
