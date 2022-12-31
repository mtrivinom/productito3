<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Students_Controller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $students = Students::orderBy('id_student', 'desc')->paginate();
        return view('students.index', compact('students'));
    }

    public function modify(Students $students) {
        return view('students.modify', compact('students'));
    }

    public function update(Request $request, Students $students) {
        $request->validate(['username' => 'required','pass' => 'required','email' => 'required','name' => 'required','surname' => 'required','telephone' => 'required','nif' => 'required','date_registered' => 'required']);
        $students ->username = $request->username;
        $students ->pass = $request->pass;
        $students ->email = $request->email;
        $students ->name = $request->name;
        $students ->surname = $request->surname;
        $students ->telephone =$request->telephone;
        $students ->nif =$request->nif;
        $students ->date_registered =$request->date_registered;
        $students ->save();
        return redirect()->route('students.get',$students);
    }

    public function get(Students $students) {
        return view('students.get', ['students' => $students]);
    }

    public function delete(Students $students){
        $students->delete();
        return redirect()->route('students.index');
    }
    
}