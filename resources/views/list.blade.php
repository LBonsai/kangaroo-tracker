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
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">

    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4 mb-4">Kangaroo Tracker App</h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="gridContainer"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn3.devexpress.com/jslib/23.1.3/js/dx.all.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
