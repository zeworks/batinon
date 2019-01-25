@extends('layouts.default') @section('content')
<!-- banner - large -->
<section>
    <div class="institutional-banner">
        @foreach($page as $item)
            <div class="image-bg" style="background-image: url('<?=Image::url($item->image,1920,900)?>')"></div>
        @endforeach
    </div>
</section>
<!-- banner - large ends -->
<div class="empty-space-20"></div>
<!-- breadcrumb -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="../" title="home">Home</a>
                    </li>
                    <li>
                        @foreach($page as $item)
                        <a href="{{$item->slug}}" title="sobre">{{ $item->title }}</a>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /breadcrumb -->
<!-- ABOUT -->
@foreach($page as $block)
    @if($block->b_title)
    <section>
        <div class="empty-space-80"></div>
        <div class="container">
            <div class="row">
                @isset($block->b_image)
                <div class="col-sm-6 col-md-5">
                    <h1>{{$block->b_title}}</h1>
                    {!! $block->b_summary !!}    
                    {!! $block->b_description !!}    
                </div>
                <div class="col-sm-6 col-md-offset-1">
                    <div class="bordered-image">
                        <img class="img-responsive" src="<?=Image::url($block->b_image,720,480)?>" alt="">
                    </div>
                </div>
                @else
                <div class=" text-center col-sm-12 col-md-8 col-md-offset-2">
                    <h1>{{$block->b_title}}</h1>
                    {!! $block->b_summary !!}    
                    {!! $block->b_description !!}    
                </div>
                @endisset
            </div>
            <div class="empty-space-80"></div>
        </div>
    </section>
    @endif
@endforeach
<!-- /ABOUT -->
@endsection
