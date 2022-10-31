<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>{{ $title }}</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>

                @auth
                    <a href="{{ route('sign.out') }}">Sair</a>
                @endauth

                @guest
                    <a href="{{ route('sign.in') }}">Entrar</a>
                @endguest
            </div>
        </nav>
        <div class="container">
            <h1 class="mt-3">{{ $title }}</h1>

            @isset($messageSuccess)
                <div class="alert alert-success">
                    {{ $messageSuccess }}
                </div>
            @endisset

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </div>
    </body>
</html>
