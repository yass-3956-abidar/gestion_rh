<?php

namespace App\Http\Controllers;

use App\Societe;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Flash;
use App\Http\Requests\UserImage;
use Illuminate\Validation\Rule;

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
    public function profile($id)
    {
        $user = User::find($id);
        $societer = DB::table('societes')->where('user_id', $user->id)->first();
        return view('user.index')->with('user', $user)
            ->with('societe', $societer);
    }
    public function parametreUser($id)
    {
        $user = User::find($id);
        return view('user.setting')->with('user', $user);
    }
    public function updateUser(Request $request)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $request->validate([
            'username' => 'required|unique:users,username,',
            'email' => Rule::unique('users')->ignore($this->route()->user->id),
            'rais_social' => "required",
            'tele' => ["required", "regex:/^(0|\+212)[1-9]([-.]?[0-9]{2}){4}$/"],
        ]);
        // $user->update($request->only('username', 'email', 'rais_social', 'tele'));
        $user->email=$request->email;
        $user->username=$request->username;
        $user->rais_social=$request->rais_social;
        $user->tele=$request->tele;
        $user->update();
        $request->session()->flash('success', " mise à jour faite avec succé");
    }
    public function updateImage(UserImage $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if ($image = $request->file('image')) {
            //$destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move('images', $profileImage);
            //$insert[]['image'] = "$profileImage";
            $user->image = $profileImage;
            $user->update();
            $request->session()->flash('success', "image mise à jour avec succé");
        } else {
            $request->session()->flash('error', "erreur lors de telechargment");
        }
        return redirect(route('user.profile', $id));
    }
}
