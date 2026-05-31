<?php

namespace App\Http\Controllers;

use App\Models\Medicos;
use Illuminate\Http\Request;

class MedicosController extends Controller
{
    public function index()
    {
        $medicos = Medicos::all();
        return view('index', compact('medicos'));
    }

    public function show($id)
    {
        $medico = Medicos::findOrFail($id);
        return view('show', compact('medico'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        Medicos::create($request->all());
        return redirect()->route('medicos.index');
    }

    public function destroy($id)
    {
        $medicos = Medicos::findOrFail($id);
        $medicos->delete();
        return redirect()->route('medicos.index');
    }
}
