<?php

namespace App\Http\Controllers;

use App\Models\Percentage;
use Illuminate\Http\Request;

class Percentage_Controller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $percentages = Percentage::paginate();
        return view('percentage.index', compact('percentages'))
        ->with('i', (request()->input('page', 1) - 1) * $percentages->perPage());
    }

    public function insert(){
        $percentages = new Percentage();
        return view('percentage.insert', compact('percentages'));
    }

    public function store(Request $request) {
        request()->validate(Percentage::$rules);
        $percentages = Percentage::create($request->all());
        return redirect()->route('percentage.index')
        ->with('success', 'Percentage Inserted');
    }

    public function show($id){
        $percentages = Percentage::find($id);
        return view('percentage.get', compact('percentages'));
    }

    public function modify($id){
        $percentages = Percentage::find($id);
        return view('percentage.modify', compact('percentages'));
    }

    public function update(Request $request, Percentage $percentages){
        request()->validate(Percentage::$rules);
        $percentages->update($request->all());
        return redirect()->route('percentage.index')
        ->with(';)', 'Percentage Modified');
    }

    public function delete($id){
        $percentages = Percentage::find($id)->delete();
        return redirect()->route('percentage.index')
        ->with('success', 'Percentage Deleted');
    }

}