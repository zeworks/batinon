<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,200i,300,300i,400,400i,500,600,700,800,900" qrel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,300i,400,400i,500,600,700,800,900" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
        crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .grid .col {
            border: 1px solid #333;
            padding: 50px;
        }
    </style>
</head>

<body>
    <main>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1><i class="far fa-file-alt u-icon-before"></i>Batinon Styleguide</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="/admin/home"><i class="fas fa-chevron-left"></i><strong>Go Back</strong></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="c-tab clearfix">
                <button type="button" class="c-btn c-tab__item">Heading</button>
                <button type="button" class="c-btn c-tab__item">Grid System</button>
                <div class="c-tab__content">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2>
                        Headings
                    </h2>
                    <br>
                    <h1>@Heading 1</h1>
                    <h2>@Heading 2</h2>
                    <h3>@Heading 3</h3>
                    <h4>@Heading 4</h4>
                    <h5>@Heading 5</h5>
                    <h6>@Heading 6</h6>
                </div>
            </div>
            <br>
            <div class="row grid">
                <div class="col-sm-12">
                    <h2>Grid System</h2>
                    <div class="col"></div>
                </div>
            </div>
            <br>
            <div class="row grid">
                <div class="col-sm-6">
                    <div class="col"></div>
                </div>
                <div class="col-sm-6">
                    <div class="col"></div>
                </div>
            </div>
            <br>
            <div class="row grid">
                <div class="col-sm-4">
                    <div class="col"></div>
                </div>
                <div class="col-sm-4">
                    <div class="col"></div>
                </div>
                <div class="col-sm-4">
                    <div class="col"></div>
                </div>
            </div>
            <br>
            <div class="row grid">
                <div class="col-sm-3">
                    <div class="col"></div>
                </div>
                <div class="col-sm-3">
                    <div class="col"></div>
                </div>
                <div class="col-sm-3">
                    <div class="col"></div>
                </div>
                <div class="col-sm-3">
                    <div class="col"></div>
                </div>
            </div>
            <br>
            <div class="row grid">
                <div class="col-sm-2">
                    <div class="col"></div>
                </div>
                <div class="col-sm-2">
                    <div class="col"></div>
                </div>
                <div class="col-sm-2">
                    <div class="col"></div>
                </div>
                <div class="col-sm-2">
                    <div class="col"></div>
                </div>
                <div class="col-sm-2">
                    <div class="col"></div>
                </div>
                <div class="col-sm-2">
                    <div class="col"></div>
                </div>
            </div>
            <br>
            <div class="row grid">
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
                <div class="col-sm-1">
                    <div class="col"></div>
                </div>
            </div>
            <br>
        </div>
    </main>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/batinon.js') }}" defer></script>
</body>

</html>