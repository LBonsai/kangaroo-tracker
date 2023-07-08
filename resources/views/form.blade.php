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
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4">Kangaroo Tracker App</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mt-4 mb-4" id="form-name"></h2>
                <form id="kangaroo-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label> <span class="text-danger">*</span>
                        <input type="text" id="name" class="form-control" placeholder="Name">
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nickname</label>
                        <input type="text" id="nickname" class="form-control" placeholder="Nickname">
                        <div class="invalid-feedback" id="nickname-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight</label> <span class="text-danger">*</span>
                        <input type="text" id="weight" class="form-control" placeholder="Weight">
                        <div class="invalid-feedback" id="weight-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="height" class="form-label">Height</label> <span class="text-danger">*</span>
                        <input type="text" id="height" class="form-control" placeholder="Height">
                        <div class="invalid-feedback" id="height-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label> <span class="text-danger">*</span>
                        <select class="form-select" id="gender">
                            <option disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="invalid-feedback" id="gender-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" id="color" class="form-control" placeholder="Color">
                        <div class="invalid-feedback" id="color-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="friendliness" class="form-label">Friendliness</label>
                        <select class="form-select" id="friendliness">
                            <option disabled selected>Select Friendliness</option>
                            <option value="friendly">friendly</option>
                            <option value="not friendly">not friendly</option>
                        </select>
                        <div class="invalid-feedback" id="friendliness-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday</label> <span class="text-danger">*</span>
                        <input type="text" id="birthday" class="form-control">
                        <div class="invalid-feedback" id="birthday-error"></div>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary me-2" id="submit" type="button">Submit</button>
                        <button class="btn btn-secondary" id="cancel" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
