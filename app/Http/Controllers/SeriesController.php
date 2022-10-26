<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::all();

        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $nome = $request->input('nome');
        $serie = new Serie();
        $serie->nome = $nome;
        $serie->save();

        return redirect('/series');
    }
}
