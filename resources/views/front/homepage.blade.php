@extends('layouts.default') @section('content')

<section>
    @if ( count($banners) > 1 )
    <div class="swiper-container swiper-container--masked">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
            <div class="swiper-slide">
                <div class="image-bg" style="background-image: url('<?=Image::url($banner->image,1920,900)?>')"></div>
                <div class="wrapper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <strong>{{ $banner->title }}</strong>
                                <p>{!! $banner->summary !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button swiper-button-next"></div>
        <div class="swiper-button swiper-button-prev"></div>
    </div>
    @else
    <div class="institutional-banner">
        @foreach($banners as $banner)
        <div class="image-bg" style="background-image: url('<?=Image::url($banner->image,1920,900)?>')">
            <div class="wrapper-slide">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <strong>{{ $banner->title }}</strong>
                            <p>{!! $banner->summary !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</section>
@endsection