<!doctype html>
<html lang="en">

<head>
    <title>CMS Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--    <link rel="stylesheet" href="{{asset('src/css/app.css')}}">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <link rel="stylesheet" href="{{asset('/src/css/styles.css')}}">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite('resources/js/app.js')
</head>
<body>
<div id="app">
    <router-view></router-view>
</div>
</body>
</html>
