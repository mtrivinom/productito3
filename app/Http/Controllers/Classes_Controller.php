<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Courses;
use App\Models\Enrollment;
use App\Models\Exams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Classes_Controller extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $id = Auth::user()->id_user;
        $user = Auth::user()->type;
        if($user == 1){ //Student
            $classes = Classes::paginate();
            return view('classes.index', compact('classes'))
            ->with('i', (request()->input('page', 1) - 1) * $classes->perPage());
        }
        if($user == 3){ //Teacher
            $classes = Classes::where('id_teacher','=',$id)->paginate();
            return view('classes.index', compact('classes'))
            ->with('i', (request()->input('page', 1) - 1) * $classes->perPage());
        }
        if($user == 2){ //Admin
            $courses = DB::table('classes')
                ->join('enrollments', 'classes.id_course', '=', 'enrollment.id_course')
                ->where('enrollment.id_student','=',Auth::user()->id)
                ->select('classes.*')
                ->paginate();
            return view('classes.index', compact('classes'))
            ->with('i', (request()->input('page', 1) - 1) * $courses->perPage());
        }

    }

    public function insert(){
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 1){
            $classes = new Classes();
            return view('classes.insert', compact('classes'));
        }
        if($user == 3){
            $classes = new Classes();
            return view('classes.insert', compact('classes'));
        }
        if($user == 2){
            return redirect()->route('classes.index')
            ->with(';)', 'Cannot Insert Class');
        }
    }

    public function store(Request $request) {
        request()->validate(Classes::$rules);
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 1){
            $classes = Classes::create($request->all());
            return redirect()->route('classes.index')
            ->with(';)', 'Class Inserted');
        }if($user == 3){
            $classes = Classes::create($request->all());
            return redirect()->route('classes.index')
            ->with(':)', 'Class Inserted');
        }if($user == 2){
            return redirect()->route('classes.index')
            ->with(';)', 'Cannot Insert Class');
        }
    }

    public function get($id){
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 1){
            $classes = Classes::find($id);
            return view('classes.get', compact('classes'));
        }if($user == 3){
            $classes = Classes::find($id);
            return view('classes.get', compact('classes'));
        }
        if($user == 2){
            $classes = Classes::find($id);
            $exam = DB::table('exams')
                ->where('exams.id_student', '=', Auth::user()->id)
                ->where('exams.id_class','=', $id)
                ->select('exams.name', 'exams.mark')
                ->first();
                return view('classes.get', compact('asignatura'), ['exam' => $exam]);
        }
    }

    public function modify($id) {
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 2){
            return redirect()->route('classes.index')
            ->with(';)', 'Cannot Modify Class');
        }else{
            $classes = Classes::find($id);
            return view('classes.modify', compact('classes'));
        }
    }

    public function update(Request $request, Classes $classes) {
        request()->validate(Classes::$rules);
        $classes->update($request->all());
        return redirect()->route('classes.index')
        ->with(';)', 'Class Modified');
    }

    public function delete($id) {
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 2){
            return redirect()->route('classes.index')
            ->with(';)', 'Cannot Delete Class');
        }else{
            $classes = Classes::find($id)->delete();
            return redirect()->route('classes.index')
            ->with(';)', 'Cannot Delete Class');
        }
    }
    
}