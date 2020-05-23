<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Societe;
use App\Employer_Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PresenceRequest;
use App\Presence;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $employers = DB::table('employers')->where('societe_id', $idsociete)->where('deleted_at', null)->get();
        foreach($employers as $employer){
            $presence[$employer->id]=Employer::find($employer->id)->presences;
        }
        return view('employer.presence.index')->with('employers', $employers)->with('tablePresence',$presence);
    }
    public function getEmployerPresence(Request $request)
    {
        // dd($request->datePresence);
        $idsocietee = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $employers = Societe::find($idsocietee)->employers;
        dd($employers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresenceRequest $request)
    {

        //teste si deja existe la presence

        $presence = new Presence();
        $presence->heur_entre = $request->heur_entre;
        $presence->heur_sortit = $request->heur_sortit;
        $presence->note = $request->note;
        $presence->employer_id = $request->id_emp;
        $presence->save();
        $request->session()->flash('success', "pointage fait avec succe et presence client");
        toast(session('success'), 'success');
        return redirect(route('presence.index'));
        // $pressenses = Employer::find($request->id_emp)->presences;
        // dd($pressenses);
    }
    public function savePresence(Request $Request, $id)
    {
    }
    public function pointerEmployer($id)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
