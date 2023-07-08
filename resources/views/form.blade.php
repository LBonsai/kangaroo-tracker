<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App Name -->
    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <form id="kangaroo-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Name">
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="nickname">Nickname</label>
                        <input type="text" id="nickname" class="form-control" placeholder="Nickname">
                        <div class="invalid-feedback" id="nickname-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="number" id="weight" class="form-control" placeholder="Weight">
                        <div class="invalid-feedback" id="weight-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="height">Height</label>
                        <input type="number" id="height" class="form-control" placeholder="Height">
                        <div class="invalid-feedback" id="height-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender">
                            <option disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="invalid-feedback" id="gender-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" id="color" class="form-control" placeholder="Color">
                        <div class="invalid-feedback" id="color-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="friendliness">Friendliness</label>
                        <select class="form-control" id="friendliness">
                            <option disabled selected>Select Friendliness</option>
                            <option value="friendly">friendly</option>
                            <option value="not friendly">not friendly</option>
                        </select>
                        <div class="invalid-feedback" id="friendliness-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" id="birthday" class="form-control">
                        <div class="invalid-feedback" id="birthday-error"></div>
                    </div>

                    <button class="btn btn-primary" id="submit" type="button">Submit</button>
                    <button class="btn btn-secondary" id="cancel" type="button">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</html>
