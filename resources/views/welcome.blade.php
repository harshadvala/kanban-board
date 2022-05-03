<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Organize anything, together. Kanban is a collaboration tool that organizes your projects into boards.">
    <title>Kanban Board</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{!! mix('css/app.css') !!}" rel="stylesheet">


</head>
<body class="antialiased" style="background-image: url({{asset('/images/img_1.png')}})">
<div id="app">
    <board></board>
    {{--    <dragable></dragable>--}}
    {{--    <hello></hello>--}}
</div>
<script src="{{ asset('js/app.js')}}"></script>

</body>
</html>
