@extends('layouts.default') 

@section('page_title', '- '. $details[0]->b_title)

@section('content')
<section>
    <div class="institutional-banner institutional-banner--masked">
        <div class="image-bg" style="background-image: url('<?=Image::url($details[0]->image,1920,900)?>')"></div>
    </div>
</section>
<div class="empty-space-20"></div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ url('/')}}" title="home">Home</a>
                    </li>
                    <li>
                        <a href="{{ url('blog')}}" title="Blog">Blog</a>
                    </li>
                    <li>
                        @foreach($details as $detail)
                        <a href="{{ $detail->slug }}" title="{{ $detail->b_title }}">{{ $detail->b_title }}</a>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="empty-space-80"></div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                @foreach($details as $detail)
                <article class="post-article">
                    <h1>{{$detail->b_title}}</h1>
                    <small>{{$detail->created_at}}</small>
                    <br>
                    <span>Postado por:
                        <strong>Diana Pampols</strong>
                    </span>
                    <br>
                    <br> {!! $detail->b_description !!}
                    <div class="share fright">
                        <div id="shareRoundIcons"></div>
                    </div>
                </article>
                @endforeach
            </div>
            <div class="col-sm-5">
            @isset($details[0]->files)
                <div class="empty-space-20"></div>
                @if (count($details[0]->files) > 1)
                <div class="owl-carousel owl-theme product-carousel">
                    @foreach($details[0]->files as $file)
                        <div class="item" data-hash="{{$file->id}}">
                            <img class="img-responsive zoom-image" src="{{ Image::url(asset('storage/images/'.$file->file_name),720,480,array('crop','')) }}"
                                alt="" data-zoom-image="{{ Image::url(asset('storage/images/'.$file->file_name),900,900,array('crop','')) }}">
                        </div>
                    @endforeach
                </div>
                <div class="product-carousel-thumbs">
                    @foreach($details[0]->files as $file)
                    <a href="#{{$file->id}}">
                        <img class="img-responsive" src="{{ Image::url(asset('storage/images/'.$file->file_name),100,100,array('crop','')) }}"
                            alt="">
                    </a>
                    @endforeach
                </div>
                @else 
                    @foreach($details[0]->files as $file)
                    <div class="bordered-image">
                        <img class="img-responsive zoom-image" src="{{ Image::url(asset('storage/images/'.$file->file_name),720,480,array('crop','')) }}"
                            alt="{{$file->file_name}}" data-zoom-image="{{ Image::url(asset('storage/images/'.$file->file_name),900,900,array('crop','')) }}">
                    </div>
                    @endforeach
                @endif
            @endisset
            </div>
        </div>
        <div class="empty-space-80"></div>
        <div id="disqus_thread"></div>
        <script>
            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

            var disqus_config = function () {
                this.page.url = '{{ url()->current() }}'; // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = '{{ url()->current() }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };

            (function () { // DON'T EDIT BELOW THIS LINE
                var d = document,
                    s = d.createElement('script');
                s.src = 'https://teste-j3wyksvwj1.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
    </div>
</section>
<div class="empty-space-80"></div>
@endsection