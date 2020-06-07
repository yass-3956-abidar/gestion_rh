<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EspaceContrller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        return view('espaceEmployer.view.index');
    }
    public function logout(Request $request)
    {
        $request->session()->forget('name');
        $request->session()->forget('id');
        return redirect(route('espace.login'));
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
    public function store(Request $request)
    {

        $employer = DB::table('employers')->where('cin', $request->matricule)
            ->where('nom_employer', $request->nom)->first();
        if ($employer == null) {
            $request->session()->flash('error', " Aucun employer avec ce matricule");
            return redirect(route('espace.login'));
        } else {
            $request->session()->put('name', $employer->nom_employer);
            $request->session()->put('cin', $employer->cin);
            $request->session()->put('id', $employer->id);
            return redirect(route('espaceEmployer.index'));
        }
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
