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
                    <a href="#" class="c-nav__link u-icon-before" data-target="1"><i class="fas fa-plus c-nav__icon"></i>Heading</a>
                </li>
                <li class="c-nav__item">
                    <a href="#" class="c-nav__link u-icon-before" data-target="2"><i class="fas fa-plus c-nav__icon"></i>Buttons
                        & Links</a>
                </li>
                <li class="c-nav__item">
                    <a href="" class="c-nav__link u-icon-before" data-target="3"><i class="fas fa-plus c-nav__icon"></i>Cards</a>
                </li>
            </ul>
        </nav>
    </aside>
    <main>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-10">
                    <h3 class="u-icon-before"><i class="far fa-file-alt"></i>Batinon Styleguide</h3>
                </div>
                <div class="col-sm-2">
                    <div class="float-right">
                        <a href="/admin/home" class="u-icon-before"><i class="fas fa-chevron-left"></i><strong>Go Back</strong></a>
                    </div>
                </div>
            </div>
            <hr>
            <div data-scope="1">
                <h4>Heading</h4>
                <hr>
                <div class="col-sm-12">
                    <h1>Some text 1</h1>
                    <h2>Some text 1</h2>
                    <h3>Some text 1</h3>
                    <h4>Some text 1</h4>
                    <h5>Some text 1</h5>
                    <h6>Some text 1</h6>
                </div>
            </div>
            <div data-scope="2">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Buttons</h4>
                    </div>
                    <div class="col-sm-6">
                        <h4>Links</h4>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-6">
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
                        <br><br>
                        <p>5. Button with icon <code>u-icon-before</code></p>
                        <button class="c-btn c-btn--primary u-icon-before"><i class="fab fa-font-awesome-flag"></i>Button
                            with icon</button>
                    </div>
                    <div class="col-sm-6">
                        <p>6. Link </p>
                        <a href="#">button text</a>
                        <br><br>
                        <p>7. Link with icon</p>
                        <a class="u-icon-before" href="#"><i class="fab fa-font-awesome-flag"></i>button text</a>
                    </div>
                </div>
            </div>
            <div data-scope="3">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Card</h4>
                        <hr>
                        <div class="c-card">
                            <div class="c-card__header">
                                <span class="f-subtitle">Card title</span>
                            </div>
                            <div class="c-card__body">
                                <div class="c-form">
                                    <label for="" class="c-form__label">Label</label>
                                    <input type="text" class="c-form__input" placeholder="text placeholder">
                                </div>
                            </div>
                            <div class="c-card__footer clearfix">
                                <div class="float-right">
                                    <button class="c-btn c-btn--text">Cancel</button>
                                    <button class="c-btn c-btn--primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
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