<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticator;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware(Authenticator::class)
            ->except('index');
    }

    public function index()
    {
        $series = Series::all();
        $messageSuccess = session('message.success');

        return view('series.index')->with('series', $series)
            ->with('messageSuccess', $messageSuccess);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $series = $this->repository->add($request);

        return to_route('series.index')
            ->with('message.success', "Série '{$series->name}' adicionada com sucesso");
    }

    public function edit(Series $serie)
    {
        return view('series.edit')->with('serie', $serie);
    }

    public function update(Series $serie, SeriesFormRequest $request)
    {
        $serie->fill($request->all());
        $serie->save();

        return to_route('series.index')
            ->with('message.success', "Série '{$serie->name}' atualizada com sucesso");
    }

    public function destroy(Series $serie)
    {
        $serie->delete();
        //Series::destroy($request->serie);
        //$request->session()->flash('message.success', "Série '{$serie->name}' removida com sucesso");

        return to_route('series.index')
            ->with('message.success', "Série '{$serie->name}' removida com sucesso");
    }
}
