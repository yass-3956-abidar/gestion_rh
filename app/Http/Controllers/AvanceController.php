<?php

namespace App\Http\Controllers;

use App\Avance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
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
        dd($employers);
        $avances = [];
        foreach ($employers as $employer) {
            $avances[$employer->id] = DB::table('avances')
                ->where('employer_id', $employer->id)
                ->whereMonth('created_at', date('m'));
        }
        $avancesTest = DB::table('avances')
            ->where('employer_id', 1)
            ->whereMonth('created_at', date('m'));
        dd($avancesTest);
        // dd(date('m'));
        // dd($avances);
        // return view('avance.index')
        //     ->with('employers', $employers)
        //     ->with('devise', $devise)
        //     ->with('avances', $avances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avance.index');
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
     * @param  \App\Avance  $avance
     * @return \Illuminate\Http\Response
     */
    public function show(Avance $avance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Avance  $avance
     * @return \Illuminate\Http\Response
     */
    public function edit(Avance $avance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Avance  $avance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avance $avance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Avance  $avance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avance $avance)
    {
        //
    }
}
