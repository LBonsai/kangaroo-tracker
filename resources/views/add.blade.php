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
                        <div class="invalid-feedback" id="name-error">
                            Please fill out this field.
                        </div>
                        <div class="invalid-feedback" id="name-chars-error">
                            Name should only contain letters, spaces, and hyphens. It must be between 1 and 50 characters long.
                        </div>
                        <div class="invalid-feedback" id="name-exist-error">
                            Name you entered already exists. Please choose a different name.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nickname">Nickname</label>
                        <input type="text" id="nickname" class="form-control" placeholder="Nickname">
                        <div class="invalid-feedback" id="nickname-chars-error">
                            Nickname should only contain letters, numbers, spaces, hyphens, and underscores. It must be between 1 and 20 characters long
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="number" id="weight" class="form-control" placeholder="Weight">
                        <div class="invalid-feedback" id="weight-error">
                            Please fill out this field.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="height">Height</label>
                        <input type="number" id="height" class="form-control" placeholder="Height">
                        <div class="invalid-feedback" id="height-error">
                            Please fill out this field.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender">
                            <option disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="invalid-feedback" id="gender-error">
                            Please select an option from the dropdown menu.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" id="color" class="form-control" placeholder="Color">
                        <div class="invalid-feedback" id="color-chars-error">
                            Color should only contain letters and spaces. It must be between 1 and 20 characters long.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="friendliness">Friendliness</label>
                        <select class="form-control" id="friendliness">
                            <option disabled selected>Select Friendliness</option>
                            <option value="friendly">friendly</option>
                            <option value="not friendly">not friendly</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" id="birthday" class="form-control">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback" id="birthday-error">Please choose a date from the calendar.</div>
                    </div>

                    <button class="btn btn-primary" id="submit" type="button">Submit</button>
                    <button class="btn btn-secondary" id="cancel" type="button">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>
