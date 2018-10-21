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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,900" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
        crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <aside>

        <nav class="c-nav">
            <ul class="u-margin-0 u-padding-0 u-unlist">
                <li class="c-nav__item">
                    <a href="#" class="c-nav__link" data-target="1"><i class="fas fa-heading c-nav__icon u-icon-before"></i>Heading</a>
                </li>
                <li class="c-nav__item">
                    <a href="#" class="c-nav__link" data-target="2"><i class="fas fa-plus c-nav__icon u-icon-before"></i>Buttons</a>
                </li>
            </ul>
        </nav>        
    </aside>
    <main>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-10">
                    <h2><i class="far fa-file-alt u-icon-before"></i>Batinon Styleguide</h2>
                </div>
                <div class="col-sm-2">
                    <div class="float-right">
                        <a href="/admin/home"><i class="fas fa-chevron-left"></i><strong>Go Back</strong></a>
                    </div>
                </div>
            </div>
            <hr>
            <div data-scope="1">
                teste
            </div>
            <div data-scope="2">
                <h6>Buttons</h6>
                <hr>
                <div class="col-sm-12">
                    <p>1. Button Primary <code>btn--primary</code> </p>
                    <button class="c-btn c-btn--primary">button primary</button>
                    <br>
                    <br>
                    <p>2. Button Default <code>btn--default</code> </p>
                    <button class="c-btn c-btn--default">button default</button>
                    <br>
                    <br>
                    <p>3. Button Outline <code>btn--outline</code> </p>
                    <button class="c-btn c-btn--outline">button outline</button>
                    <br>
                    <br>
                    <p>4. Button Text <code>btn--text</code> </p>
                    <button class="c-btn c-btn--text">button text</button>

                </div>
            </div>
            <!-- <div class="c-tab clearfix">
                <div class="c-tab__items">
                    <button data-target="1" type="button" class="c-btn c-tab__button">Heading</button>
                    <button data-target="2" type="button" class="c-btn c-tab__button">Tab 2</button>
                </div>
                <div class="c-tab__content" data-tab="1">
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
                <div class="c-tab__content" data-tab="2"></div>
            </div> -->
            <br>
        </div>
    </main>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/batinon.js') }}" defer></script>
</body>

</html>