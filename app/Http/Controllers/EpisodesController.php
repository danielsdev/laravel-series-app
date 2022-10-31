<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'messageSuccess' => session('message.success'),
        ]);
    }

    public function watched(Request $request, Season $season)
    {
        $watchedEpisodes = $request->episodes ?? [];
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });

        $season->push();

        return to_route('episodes.index', $season->id)
            ->with('message.success', 'Episódios marcados como assistidos!');;
    }
}
