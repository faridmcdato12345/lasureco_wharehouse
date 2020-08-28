<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();
        $role = DB::table('roles')->where('id',Auth::user()->role)->value('name');
        return view('user.change_pass',compact('users','role'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePass(Request $request)
    {
        $request->validate([
            'old' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'new_password' => ['same:new_password'],
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Auth::logout();
        return redirect('/login');
    }
}
