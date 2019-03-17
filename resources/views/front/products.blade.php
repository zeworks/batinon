@extends('layouts.default') @section('content')
<section>
    <div class="institutional-banner institutional-banner--masked">
        <div class="image-bg" style="background-image: url('<?=Image::url($banner[0]->image,1920,900)?>')"></div>
    </div>
</section>
<div class="empty-space-20"></div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="#home" title="home">Home</a>
                    </li>
                    <li>
                        <a href="products.php" title="Products">Products</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="empty-space-80"></div>
<section>
    <div class="container">
        <div class="row matchheight">
            <!-- loop from here -->
            @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3" data-mh="product-item">
                <div class="product-card">
                    <a href="produtos/{{$product->slug}}" title="{{$product->title}}">
                        <img class="img-responsive" src="<?=Image::url($product->image,1920,900)?>" alt="">
                    </a>
                    <a href="produtos/{{$product->slug}}" title="{{$product->title}}">
                        <span class="product-card__category">{{$product->category}}</span>
                        <h4 class="product-card__title">{{$product->title}}</h4>
                    </a>
                    @if($settings[0]->website_mode_store == '1')
                    <span class="product-card__price">10€</span>
                    <span class="product-card__oldprice">19€</span>
                    @endif
                    <div class="clearfix"></div>
                    <a href="produtos/{{$product->slug}}" class="btn btn-primary">Visualizar</a>
                </div>
            </div>
            @endforeach
            <!-- end loop -->
        </div>
    </div>
</section>
@endsection