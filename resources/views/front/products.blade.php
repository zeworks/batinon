@extends('layouts.default') @section('content')
<section>
    <div class="institutional-banner institutional-banner--masked">
        <div class="image-bg" style="background-image: url(https://dummyimage.com/1920x900/f2f2f2/000)"></div>
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
        {{$products}}
            <!-- loop from here -->
            <div class="col-sm-6 col-md-4 col-lg-3" data-mh="product-item">
                <div class="product-card">
                    <a href="product.php" title="product title">
                        <img class="img-responsive" src="https://dummyimage.com/345x345/f2f2f2/000" alt="">
                    </a>
                    <a href="product.php" title="product title">
                        <span class="product-card__category">Category Product</span>
                        <h4 class="product-card__title">Product Name</h4>
                    </a>
                    @if($settings[0]->website_mode_store == '1')
                    <span class="product-card__price">10€</span>
                    <span class="product-card__oldprice">19€</span>
                    @endif
                    <div class="clearfix"></div>
                    <a href="product.php" class="btn btn-primary">Visualizar</a>
                </div>
            </div>
            <!-- end loop -->
        </div>
    </div>
</section>
@endsection