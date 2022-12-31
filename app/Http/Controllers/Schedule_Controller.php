<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Schedule_Controller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 1){
            $schedules = Schedule::paginate();
            return view('schedule.index', compact('schedules'))
           ->with('i', (request()->input('page', 1) - 1) * $schedules->perPage());
        }if($user == 3){
            $schedules = DB::table('schedules')
                 ->join('asignaturas', function($join){
                        $join->on('schedule.id_class', '=', 'class.id_class')
                        ->where('class.id_teacher', '=', Auth::user()->id);
                    })
                    ->paginate();
                    return view('schedule.index', compact('schedules'))
                    ->with('i', (request()->input('page', 1) - 1) * $schedules->perPage());
        }    
    }

    public function insert() {
        $schedules = new Schedule();
        return view('schedule.insert', compact('schedules'));
    }

    public function store(Request $request) {
        request()->validate(Schedule::$rules);
        $schedules = Schedule::create($request->all());
        return redirect()->route('schedule.index')
        ->with(';)', 'Schedule Inserted');
    }

    public function show($id){
        $schedules = Schedule::find($id);
        return view('schedule.get', compact('schedules'));
    }

    public function modify($id){
        $schedules = Schedule::find($id);
        return view('schedule.modify', compact('schedules'));
    }

    public function update(Request $request, Schedule $schedules){
        request()->validate(Schedule::$rules);
        $schedules->update($request->all());
        return redirect()->route('schedule.index')
        ->with('success', 'Schedule Modified');
    }

    public function delete($id) {
        $schedules = Schedule::find($id)->delete();
        return redirect()->route('schedule.index')
        ->with('success', 'Schedule Deleted');
    }
    
}