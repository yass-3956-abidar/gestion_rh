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
use PDF;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presence = [];
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $employers = DB::table('employers')->where('societe_id', $idsociete)->where('deleted_at', null)->get();
        foreach ($employers as $employer) {
            $presence[$employer->id] = DB::table('presences')->where('employer_id', $employer->id)->where('date_pointe', date('yy-m-d'))->get();
        }
        return view('presence.index')->with('employers', $employers)->with('tablePresence', $presence);
    }
    public function getEmployerPresence(Request $request)
    {

        $idsocietee = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $employers = Societe::find($idsocietee)->employers;
        if ($request->ajax()) {
            $data = '';
            $output = '';
            $query = $_GET['query'];
            if ($query != '') {
                $datepresenceFormat = date("yy-m-d", strtotime($query));
                foreach ($employers as $employer) {
                    $presences[$employer->id] = DB::table('presences')->where('employer_id', $employer->id)->where('date_pointe', $datepresenceFormat)->get();
                }
                foreach ($employers as $employer) {
                    foreach ($presences[$employer->id] as $presence) {
                        $output .= '
                  <tr>
                    <td>' . $employer->nom_employer . " " . $employer->prenom . '</td>
                     <td>
                        <ul class="list-group list-group-horizontal">
                        <li class="list-group-item active mr-1">
                              <button class="text-center"> ' . $presence->heur_entre . " " . $presence->heur_sortit .
                            '</button>
                          </li>
                        </ul>
                     </td>
                    </tr>
                    ';
                    }
                }
                $data = $output;
                echo json_encode($data);
            }
        } else {
            echo "not found";
        }
    }

    public function getpdfF()
    {
        $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        $pdf = PDF::loadView('test', $data);

        return $pdf->download('test.pdf');
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
    public function deletePresence(Request $request)
    {
        $presence = Presence::find($request->input('id'));
        if ($presence->delete()) {
            return response()->json(['success' => 'Data Deleted  successfully.']);
        }
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
        $presence->date_pointe = $request->date_pointe;
        $presence->save();
        $request->session()->flash('success', "pointage fait avec succe");
        toast(session('success'), 'success');
        return redirect(route('presenceEmp.index'));
    }
    public function saveAll(Request $request)
    {
        dd($request->heur_entre);
        foreach ($request->select_empl as $id_emp) {
            $employer = Employer::find($id_emp);
            $presence = new Presence();
            $presence->heur_entre = $request->heur_entre;
            $presence->heur_sortit = $request->heur_sortit;
            $presence->note = $request->note;
            $presence->employer_id = $employer->id;
            $presence->date_pointe = date('yy-m-d');
            $presence->save();
        }
        $cmp = count($request->select_empl);
        $request->session()->flash('success', "$cmp employer sont pointe avec succé");
        toast(session('success'), 'success');
        return response()->json([
            'staus' => true,
        ]);
    }
    public function savePresence(Request $Request, $id)
    {
    }
    public function pointerEmployer()
    {
        // return view('employer.presence.historique');
        $presence = [];
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $employers = DB::table('employers')->where('societe_id', $idsociete)->where('deleted_at', null)->get();
        foreach ($employers as $employer) {
            $presence[$employer->id] = DB::table('presences')->where('employer_id', $employer->id)->where('date_pointe', date('yy-m-d'))->get();
        }

        return view('presence.historique')->with('employers', $employers)->with('tablePresence', $presence);
        // dd('hi');
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
    public function updatePresence(PresenceRequest $request)
    {
        $presence =  Presence::find($request->id_presence);
        $presence->heur_sortit = $request->heur_sortit;
        $presence->heur_entre = $request->heur_entre;
        $presence->note = $request->note;
        $presence->update();
        return redirect(route('presenceEmp.index'));
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
