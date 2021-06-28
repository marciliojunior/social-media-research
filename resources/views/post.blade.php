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
    <div class="container-fluid mt-3">
        <h2>Post information</h2>
        <div class="alert alert-info" role="alert">
            <strong>Person:</strong> {{ $post->account->person->name }} |
            <strong>Gender:</strong> {{ $post->account->person->gender == 'M' ? 'Male' : 'Female' }} |
            <strong>City/State:</strong> {{ $post->account->person->city .' / '.$post->account->person->state }} |
            <strong>Social Network:</strong> {{ $post->account->social_network->name }} |
            <strong>Datetime of post:</strong> {{ $post->post_date }}
        </div>
        <h2>Post content</h2>
        <iframe width="100%" height="500px" src="{{ route('post-content', $post->id) }}"></iframe>
    </div>

    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>
</html>
