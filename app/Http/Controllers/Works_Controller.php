<?php

namespace App\Http\Controllers;

use App\Models\Works;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Works_Controller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if($user == 1){
            $works = Works::paginate();
            return view('works.index', compact('works'))
            ->with('i', (request()->input('page', 1) - 1) * $works->perPage());
        }
        if($user == 3){
            $works = DB::table('works')
            ->join('asignaturas', function($join)
            {
                   $join->on('works.id_class', '=', 'classes.id_class')
                        ->where('classes.id_teacher', '=', Auth::user()->id);
               })
               ->paginate();
               return view('work.index', compact('works'))
            ->with('i', (request()->input('page', 1) - 1) * $works->perPage());
        }

    }

    public function insert()
    {
        $work = new Works();
        return view('works.insert', compact('works'));
    }

    public function store(Request $request) {
        request()->validate(Works::$rules);
        $works = Works::create($request->all());
        return redirect()->route('works.index')
        ->with(';)', 'Work Inserted');
    }

    public function get($id) {
        $works = Works::find($id);
        return view('works.get', compact('works'));
    }

    public function modify($id) {
        $work = Works::find($id);
        return view('works.modify', compact('works'));
    }

    public function update(Request $request, Works $works) {
        request()->validate(Works::$rules);
        $works->update($request->all());
        return redirect()->route('works.index')
        ->with(';)', 'Work Modified');
    }

    public function delete($id) {
        $works = Works::find($id)->delete();
        return redirect()->route('works.index')
        ->with('success', 'Work Deleted');
    }
    
}