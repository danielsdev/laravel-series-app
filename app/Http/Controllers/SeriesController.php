<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;

class SeriesController extends Controller
{
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
        $series = Series::create($request->all());
        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $series->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($series->seasons as $season) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j,
                ];
            }
        }
        Episode::insert($episodes);

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
