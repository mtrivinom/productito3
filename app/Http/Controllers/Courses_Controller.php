<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCourses;
use App\Models\Enrollment;
use Psy\CodeCleaner\EmptyArrayDimFetchPass;

class Courses_Controller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 1){
            $courses = Courses::orderBy('id_course','desc')->paginate();
            return view('courses.index', compact('courses'));
        }
        if($user == 2){
            $enrollments = Enrollment::where('id_student', '=', Auth::user()->id)->get();
            if(sizeof($enrollments) == 0){
                $courses = Courses::orderBy('id_course','desc')->paginate();
                return view('courses.index', compact('courses'))->with(';)', 'No Courses');
            }else{
                return redirect()->route('courses.index')->with(';)', 'Your Courses:');

            }
        }
    }

    public function insert(){
        return view('courses.insert');
    }

    public function store(Request $request){
        $courses = new Courses();
        $request->validate(['name'=>'required','description'=>'required','date_start'=>'required','date_end'=>'required','active'=>'required']);
        $courses ->name = $request->name;
        $courses ->description = $request->description;
        $courses ->date_start = $request->date_start;
        $courses ->date_end = $request->date_end;
        $courses ->active = $request->active;
        $courses->save();
        return redirect()->route('courses.get',$courses);
     }

     public function show(Courses $courses){
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 1){
            return view('courses.get',['courses' => $courses]);
        }
        if($user == 2){
            $enrollment = Enrollment::create(['id_student' => $id,'id_course' => $courses->id,'status' => '1']);
            return redirect()->route('courses.index')->with(';)', 'Your Course:'.$courses->name);
        }
    }

    public function modify(Courses $courses){
        return view('courses.modify',compact('courses'));
    }

    public function update(Request $request, Courses $courses){
        $courses ->name = $request->name;
        $courses ->description = $request->description;
        $courses ->date_start = $request->date_start;
        $courses ->date_end = $request->date_end;
        $courses ->active = $request->active;
        $courses->save();
        return redirect()->route('courses.get',$courses);
    }

    public function delete(Courses $courses){
        $courses->delete();
        return redirect()->route('courses.index');
    }

}