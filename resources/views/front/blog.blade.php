@extends('layouts.default') @section('content')
@if(count($banner) > 0)
<section>
    <div class="institutional-banner institutional-banner--masked">
        <div class="image-bg" style="background-image: url('<?=Image::url($banner[0]->image,1920,900)?>')">
            <div class="wrapper-slide">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <strong>{{ $banner[0]->title }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<div class="empty-space-20"></div>
<!-- breadcrumb -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ url('/')}}" title="home">Home</a>
                    </li>
                    <li>
                        <a href="{{ url('blog') }}" title="blog">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /breadcrumb -->
<!-- BLOG SECTION -->
<div class="empty-space-80"></div>
<section>
    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-sm-6">
                <article class="post-article">
                    <a href="{{ url('blog').'/'.$blog->slug }}" title="{{$blog->b_title}}">
                        <img class="img-responsive" src="<?= Image::url($blog->image,720,480) ?>" alt="">
                    </a>
                    <h2>{{$blog->b_title}}</h2>
                    <small>{{$blog->created_at}}</small>
                    <br><br>
                    <div class="text-ellipses">
                        {!! $blog->b_summary !!}        
                    </div>
                    <a href="{{ url('blog').'/'.$blog->slug }}" class="btn btn-primary" title="{{$blog->b_title}}">Ver mais</a>
                </article>
                <div class="empty-space-80"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- BLOG SECTION-->
@endsection