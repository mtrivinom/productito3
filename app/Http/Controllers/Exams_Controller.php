<?php

namespace App\Http\Controllers;

use App\Models\Exams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Exams_Controller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $id = Auth::user()->id;
        $user = Auth::user()->type;
        if ($user == 1) {
            $exams = Exams::paginate();
            return view('exams.index', compact('exams'))
            ->with('i', (request()->input('page', 1) - 1) * $exams->perPage());
        }
        if ($user == 3) {
            $exams = DB::table('exams')
                ->join('class', function ($join) {
                    $join->on('exams.id_class', '=', 'class.id_class')
                    ->where('class.id_teacher', '=', Auth::user()->id);
                })
                ->paginate();
            return view('exams.index', compact('exams'))
            ->with('i', (request()->input('page', 1) - 1) * $exams->perPage());
        }
    }

    public function insert() {
        $exams = new Exams();
        return view('exams.insert', compact('exams'));
    }

    public function store(Request $request) {
        request()->validate(Exams::$rules);
        $exams = Exams::create($request->all());
        return redirect()->route('exams.index')
        ->with(';)', 'Exam Inserted');
    }

    public function get($id) {
        $exams = Exams::find($id);
        return view('exams.get', compact('exams'));
    }

    public function modify($id) {
        $exams = Exams::find($id);
        return view('exams.modify', compact('exams'));
    }

    public function update(Request $request, Exams $exams) {
        request()->validate(Exams::$rules);
        $exams->update($request->all());
        return redirect()->route('exams.index')
        ->with(';)', 'Exam Modified');
    }

    public function delete($id) {
        $exams = Exams::find($id)->delete();
        return redirect()->route('exams.index')
        ->with(';)', 'Exam Deleted');
    }
    
}