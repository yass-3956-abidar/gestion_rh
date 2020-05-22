<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Contrat;
use App\ContratType;
use App\Departement;
use App\Http\Requests\EmployerRequest;
use Illuminate\Contracts\Encryption\DecryptException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
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
        // $idsociete=DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        // $employers=DB::table('employers')->where('societe_id',$idsociete)->get();
        // $contrats=DB::table('contrats')->where('employer_id','=',$employers->id)->get();
        // $departement=DB::table('departements')->where('id',$employers->departement_id)->first();
        // $post=DB::table('emplois')->where('id',$employers->emploi_id)->first();
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $devise = DB::table('societes')->where('user_id', Auth::user()->id)->value('devise');
        $employers = DB::table('employers')->where('societe_id', $idsociete)->where('deleted_at', null)->get();
        return view('employer.index')->with('employers', $employers)->with('devise', $devise);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // example:


        return view('employer.create')->with('employer', null);
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
        $departemetn = DB::table('departements')->where('nom_dep', $request->nom_dep)->first();
        if ($departemetn != null) {
            $departemetnid = $departemetn->id;
        } else {
            $dateDep = $request->only('nom_dep');
            Departement::create($dateDep);
            $departemetnid = DB::table('departements')->max('id');
        }

        //save Banque
        $dataBanque = $request->only('nom_banque', 'adresse', 'tele');
        $dataBanque['rib'] = encrypt($request->rib);
        Banque::create($dataBanque);
        $dataEmployer = $request->only('cin', 'nom_employer', 'prenom', 'email', 'date_naissance', 'nbr_enfant', 'situationFami', 'sexe', 'Num_cnss', 'Num_Icmr', 'salaire');
        if ($image = $request->file('image')) {
            //$destinationPath = 'public/image/'; // upload path
            // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move('images', $profileImage);
            //$insert[]['image'] = "$profileImage";
            $dataEmployer['image'] = $request->image->store('images', 'public');
        } else {
            if($request->sexe=="femme"){
                $dataEmployer['image'] = 'femme.png';
            }else if($request->sexe=="homme")
            $dataEmployer['image'] = 'persons.png';
        }
        // dd($dataEmployer);
        $dataEmployer['emploi_id'] = DB::table('emplois')->max('id');
        $dataEmployer['banque_id'] = DB::table('banques')->max('id');
        $dataEmployer['departement_id'] = $departemetnid;
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
        $dataContrat['contra_type_id'] = $contraTypeId;
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

        $contrat = DB::table('contrats')->where('employer_id', '=', $employer->id)->first();
        $departement = DB::table('departements')->where('id', $employer->departement_id)->first();
        $post = DB::table('emplois')->where('id', $employer->emploi_id)->first();
        $banque = DB::table('banques')->where('id', $employer->banque_id)->first();

        $banque->rib = $banque->rib;

        $contratType = DB::table('contrat_types')->where('id', $contrat->contra_type_id)->first();
        $devise = DB::table('societes')->where('user_id', Auth::user()->id)->value('devise');
        return view('employer.show')->with('contrat', $contrat)->with('departement', $departement)->with('post', $post)->with('banque', $banque)->with('employer', $employer)->with('contratType', $contratType)->with('devise', $devise);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        $contrat = DB::table('contrats')->where('employer_id', '=', $employer->id)->first();
        $departement = DB::table('departements')->where('id', $employer->departement_id)->first();
        $post = DB::table('emplois')->where('id', $employer->emploi_id)->first();
        $banque = DB::table('banques')->where('id', $employer->banque_id)->first();
        $contratType = DB::table('contrat_types')->where('id', $contrat->contra_type_id)->first();
        return view('employer.create')->with('employer', $employer)->with('contratType', $contratType)->with('departement', $departement)->with('post', $post)->with('banque', $banque)->with('contart', $contrat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(EmployerRequest $request, Employer $employer)
    {

        // App\Flight::where('active', 1)
        // ->where('destination', 'San Diego')
        // ->update(['delayed' => 1]);
        // $departement = DB::table('departements')->where('id', $employer->departement_id)->update([
        //     'nom_dep' => $request->nom_dep
        // ]);
        $departemet = Departement::find($employer->departement_id);
        $departemet->nom_dep = $request->nom_dep;
        $departemet->update();

        // Departement::where('id', $employer->departement_id)->update([
        //     'nom_dep' => $request->nom_dep
        // ]);
        // $post = DB::table('emplois')->where('id', $employer->emploi_id)->update([
        //     'fonction' => $request->fonction,
        //     'date_debut' => $request->date_debut,
        //     'date_fin' => $request->date_fin,
        //     'salaire_base' => $request->salaire_base,
        // ]);
        Emploi::where('id', $employer->emploi_id)->update([
            'fonction' => $request->fonction,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'salaire_base' => $request->salaire_base,
        ]);
        Banque::where('id', $employer->banque_id)->update([
            'nom_banque' => $request->nom_banque,
            'adresse' => $request->adresse,
            'tele' => $request->tele,
            'rib' => $request->rib
        ]);

        $contrat = DB::table('contrats')->where('employer_id', $employer->id)->first();
        $contrat->date_embauche = $request->date_embauche;
        // dd($contrat);
        $contratType = DB::table('contrat_types')->where('id', $contrat->contra_type_id)->update(['type' => $request->type]);
        if ($image = $request->file('image')) {
            $image = $request->image->store('images', 'public');
        } else {
            $image = 'person.png';
        }
        $employer->update([
            'cin' => $request->cin,
            'nom_employer' => $request->nom_employer,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'nbr_enfant' => $request->nbr_enfant,
            'situationFami' => $request->situationFami,
            'sexe' => $request->sexe,
            'Num_cnss' => $request->Num_cnss,
            'Num_Icmr' => $request->Num_Icmr,
            'salaire' => $request->salaire,
            'image' => $image,
        ]);
        $request->session()->flash('success', "l'employer updated");
        toast(session('success'), 'success');
        return redirect(route('employer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employer = Employer::find($id);

        $employer->delete();

        return redirect(route('employer.index'));
    }
    public function InfoCalculSalire()
    {
        return view('outil.salaire');
    }
    public function infoIr()
    {
        return view('outil.ir');
    }
}
