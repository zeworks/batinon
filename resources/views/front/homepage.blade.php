@extends('layouts.default') @section('content')

<section>
    <!-- IF MORE THEN ONE IMAGE -->
    <!-- <div class="swiper-container swiper-container--masked">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="image-bg" style="background-image: url(https://dummyimage.com/1920x900/000/fff)"></div>
                <div class="wrapper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <strong>teste</strong>
                                <p>teste</p>
                                <a href="">te</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="image-bg" style="background-image: url(../assets/img/cartoes-JFY.jpg)"></div>
                <div class="wrapper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <strong>teste</strong>
                                <p>teste</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button swiper-button-next"></div>
        <div class="swiper-button swiper-button-prev"></div>
    </div> -->
    <!-- IF ONLY ONE IMAGE -->
    <div class="institutional-banner">
        <div class="image-bg" style="background-image: url(https://dummyimage.com/1920x900/000/fff)">
            <div class="wrapper-slide">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <strong>teste</strong>
                            <p>teste</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection