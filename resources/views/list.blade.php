<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App Name -->
    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//cdn3.devexpress.com/jslib/23.1.3/css/dx.light.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="dx-viewport">
    <div class="container">
        <div id="gridContainer"></div>
    </div>
</body>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn3.devexpress.com/jslib/23.1.3/js/dx.all.js"></script>

</html>
