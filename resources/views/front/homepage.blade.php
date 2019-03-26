@extends('layouts.default') @section('content')
<section>
    @if ( count($data['banners']) > 1 )
    <div class="swiper-container swiper-container--masked">
        <div class="swiper-wrapper">
            @foreach($data['banners'] as $banner)
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
    <div class="institutional-banner institutional-banner--masked">
        @foreach($data['banners'] as $banner)
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

<section>
    <div class="empty-space-80"></div>
    @foreach($data['articles'] as $key => $article)
    <article class="post-article">
        <div class="container">
            <div class="row matchheight">
                @if($key % 2)
                  <div class="col-sm-6 col-xs-12 col-sm-push-6" data-mh="post-article">
                @else
                  <div class="col-sm-6 col-xs-12" data-mh="post-article">
                @endif
                    <a href="blog/{{$article->slug}}" title="{{$article->b_title}}">
                        <div class="bordered-image">
                            <img class="img-responsive" src="<?=Image::url($article->image,1920,900)?>" alt="">
                        </div>
                    </a>
                </div>
                @if($key % 2)
                  <div class="col-sm-6 col-md-5 col-md-offset-1 col-xs-12 col-sm-pull-6 col-md-pull-7" data-mh="post-article">
                @else
                  <div class="col-sm-6 col-md-5 col-md-offset-1 col-xs-12" data-mh="post-article">
                @endif
                    <h2>{{$article->b_title}}</h2>
                    <div class="text-ellipses">
                        {!! $article->b_summary !!}
                    </div>
                    <a href="blog/{{$article->slug}}" class="btn btn-primary" title="{{$article->b_title}}">Ver mais</a>
                </div>
            </div>
        </div>
    </article>
    <div class="empty-space-80"></div>
    @endforeach
</section>
@endsection