<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Marcílio Jr." />
        <meta name="DC.creator.address" content="marcilio@outlook.com" />
        <title>{{ config('app.name') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('config-window')

        <div class="container-fluid mt-3">
            <h1 class="text-center mb-5">
                <span>Social Media Lists v2</span>
                <small>{{ config('app.name') }}</small>
            </h1>

            <div id="main"></div>
        </div>

        <script type="text/javascript">
            @isset($javascript_vars)
                @foreach($javascript_vars as $var => $val)
                    window['{{ $var }}'] = {!! json_encode($val) !!};
                @endforeach
            @endisset
        </script>
        <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
