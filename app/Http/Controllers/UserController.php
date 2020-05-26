<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rais_social' => ['required', 'string'],
            'tele' => ["required", "regex:/^(0|\+212)[1-9]([-.]?[0-9]{2}){4}$/"]
        ]);
        // dd($request);
        $user = new User();
        // $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->rais_social = $request->rais_social;
        $user->tele = $request->tele;
        $user->save();
        // Auth::make($user);;
        auth()->login($user);
        return redirect(route('registration'));
        // return view('auth.registration');
    }
}
