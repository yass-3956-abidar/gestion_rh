<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Contrat;
use App\ContratType;
use App\Departement;
use App\Http\Requests\EmployerRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Employer;
use Illuminate\Http\Request;
use App\Emploi;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employers = Employer::all();
        return view('employer.index')->with('employers', $employers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployerRequest $request)
    {         //save Emploi

        $dataEmploi = $request->only('fonction', 'date_debut', 'date_fin', 'salaire_base');
        Emploi::create($dataEmploi);
        //save deprtemetn
        $dateDep = $request->only('nom_dep');
        Departement::create($dateDep);
        //save Banque
        $dataBanque = $request->only('nom_banque', 'adresse', 'tele');
        $dataBanque['rib'] = Hash::make($request->rib);
        Banque::create($dataBanque);
        // // save emoloyer

        $dataEmployer = $request->only('cin', 'nom_employer', 'prenom', 'email', 'date_naissance','nbr_enfant', 'situationFami', 'sexe', 'Num_cnss', 'Num_Icmr', 'salaire');
        if ($image = $request->file('image')) {
            //$destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move('images', $profileImage);
            //$insert[]['image'] = "$profileImage";
            $dataEmployer['image']=$profileImage;
        }else{
            $dataEmployer['image']='person.png';
        }
        // dd($dataEmployer);
        $dataEmployer['emploi_id'] = DB::table('emplois')->max('id');
        $dataEmployer['banque_id'] = DB::table('banques')->max('id');
        $dataEmployer['departement_id'] = DB::table('departements')->max('id');
        $dataEmployer['societe_id'] = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        //save contrat type;
        $contraTypeId = 0;
        $contraType = DB::table('contrat_types')->where('type', $request->type)->first();
        if ($contraType == null) {
            $dataContratType = $request->only('type');
            ContratType::create($dataContratType);
            $contraTypeId = DB::table('contrat_types')->max('id');
        } else if ($contraType != null) {
            $contraTypeId = $contraType->id;
        }
        Employer::create($dataEmployer);
        //save contrat
        $dataContrat = $request->only('date_embauche');
        $dataContrat['employer_id'] = DB::table('employers')->max('id');
        $dataContrat['conget_type_id'] = $contraTypeId;
        Contrat::create($dataContrat);
        $request->session()->flash('success', "Nouvelle employer est ajouter avec succes");
        toast(session('success'), 'success');
        return redirect(route('employer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employer $employer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
    {
        //
    }
}
