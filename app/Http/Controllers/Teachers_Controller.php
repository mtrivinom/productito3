<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTeachers;
use App\Models\Enrollment;
use Psy\CodeCleaner\EmptyArrayDimFetchPass;

class Teachers_Controller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 1){
            $courses = Teachers::orderBy('id_teacher','desc')->paginate();
            return view('teachers.index', compact('teachers'));
        }
        if($user == 2){
            $enrollments = Enrollment::where('id_student', '=', Auth::user()->id)->get();
            if(sizeof($enrollments) == 0){
                $teachers = teachers::orderBy('id_teacher','desc')->paginate();
                return view('teachers.index', compact('teachers'))->with(';)', 'No Teachers');
            }else{
                return redirect()->route('teachers.index')->with(';)', 'Your Teachers:');

            }
        }
    }

    public function insert(){
        return view('teachers.insert');
    }

    public function store(Request $request){
        $teachers = new Teachers();
        $request->validate(['name' => 'required','surname' => 'required','telephone' => 'required','nif' => 'required','email' => 'required']);
        $teachers ->name = $request->name;
        $teachers ->surname = $request->surname;
        $teachers ->telephone = $request->telephone;
        $teachers ->nif = $request->nif;
        $teachers ->email = $request->email;
        $teachers->save();
        return redirect()->route('teachers.get',$teachers);
     }

     public function show(Teachers $teachers){
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 1){
            return view('teachers.get',['teachers' => $teachers]);
        }
        if($user == 2){
            $enrollment = Enrollment::create(['id_student' => $id,'id_teacher' => $teachers->id,'status' => '1']);
            return redirect()->route('teachers.index')->with(';)', 'Your Teacher:'.$teachers->name);
        }
    }

    public function modify(Teachers $teachers){
        return view('teachers.modify',compact('teachers'));
    }

    public function update(Request $request, Teachers $teachers){
        $teachers ->name = $request->name;
        $teachers ->surname = $request->surname;
        $teachers ->telephone = $request->telephone;
        $teachers ->nif = $request->nif;
        $teachers ->email = $request->email;
        $teachers->save();
        return redirect()->route('teachers.get',$teachers);
    }

    public function delete(Teachers $teachers){
        $teachers->delete();
        return redirect()->route('teachers.index');
    }

}