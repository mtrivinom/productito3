<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class User_Controller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $users = User::orderBy('id', 'desc')->paginate();
        return view('user.index', compact('users'));
    }

    public function modify(User $user) {
        return view('user.modify', compact('user'));
    }

    public function update(Request $request, User $user) {
        $request->validate(['username' => 'required','name' => 'required','email' => 'required','password' => 'required','type' => 'required']);
        $user ->username = $request->username;
        $user ->name = $request->name;
        $user ->email = $request->email;
        $user ->password = Hash::make($request->password);
        $user ->type =$request->type;
        $user->save();
        return redirect()->route('user.get',$user);
    }

    public function get(User $user) {
        return view('user.get', ['user' => $user]);
    }

    public function delete(User $user){
        $user->delete();
        return redirect()->route('user.index');
    }
    
}