<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Admins_Controller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $admins = Admins::orderBy('id_user_admin', 'desc')->paginate();
        return view('admins.index', compact('admins'));
    }

    public function modify(Admins $admins) {
        return view('admins.modify', compact('admins'));
    }

    public function update(Request $request, Admins $admins) {
        $request->validate(['username' => 'required','name' => 'required','email' => 'required','password' => 'required']);
        $admins ->username = $request->username;
        $admins ->name = $request->name;
        $admins ->email = $request->email;
        $admins ->password = Hash::make($request->password);
        $admins->save();
        return redirect()->route('admins.get',$admins);
    }

    public function get(Admins $admins) {
        return view('admins.get', ['admins' => $admins]);
    }

    public function delete(Admins $admins){
        $admins->delete();
        return redirect()->route('admins.index');
    }
    
}