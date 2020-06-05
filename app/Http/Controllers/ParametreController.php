<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Presence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index()
    {
        $idsociete = DB::table('societes')->where('user_id', Auth::user()->id)->value('id');
        $devise = DB::table('societes')->where('user_id', Auth::user()->id)->value('devise');
        $employers = Employer::onlyTrashed()
            ->where('societe_id', $idsociete)
            ->get();
        $employersTab = [];
        foreach ($employers as $employer) {
            $employersTab[$employer->id] = $employer->id;
        }
        $presence = Presence::onlyTrashed()
            ->whereIn('employer_id', $employersTab)
            ->get();
        return view('para.index')->with([
            'employers' => $employers,
            'devise' => $devise,
            'presence'=>$presence,
        ]);
    }
    public function restoref($id)
    {
        $employer = Employer::onlyTrashed()
            ->where('id', $id)
            ->first();
        $employer->restore();
        session()->flash('success', "l'employer est ajouter avec succes");
        toast(session('success'), 'success');
        return redirect(route('para.index'));
    }
}
