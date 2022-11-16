@component('mail::message')

# {{ $seriesName }} criada

A série {{ $seriesName }} com {{ $numberOfSeasons }} temporadas e {{ $episodesPerSeason }} episódios foi criada

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $seriesId)])
    Ver série
@endcomponent

@endcomponent
