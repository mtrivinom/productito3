<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class Enrollment_Controller extends Controller {
   
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $enrollments = Enrollment::paginate();
        return view('enrollment.index', compact('enrollments'))
            ->with('i', (request()->input('page', 1) - 1) * $enrollments->perPage());
    }

    public function insert() {
        $enrollments = new Enrollment();
        return view('enrollment.insert', compact('enrollments'));
    }

    public function store(Request $request) {
        request()->validate(Enrollment::$rules);
        $enrollments = Enrollment::create($request->all());
        return redirect()->route('enrollment.index')
        ->with(':)', 'Enrollment Inserted');
    }

    public function get($id) {
        $enrollments = Enrollment::find($id);
        return view('enrollment.get', compact('enrollments'));
    }

    public function modify($id) {
        $enrollments = Enrollment::find($id);
        return view('enrollment.modify', compact('enrollments'));
    }

    public function update(Request $request, Enrollment $enrollments) {
        request()->validate(Enrollment::$rules);
        $enrollments->update($request->all());
        return redirect()->route('enrollment.index')
            ->with(';)', 'Enrollment Modified');
    }

    public function delete($id) {
        $enrollments = Enrollment::find($id)->delete();
        return redirect()->route('enrollment.index')
        ->with(';)', 'Enrollment Deleted');
    }
    
}