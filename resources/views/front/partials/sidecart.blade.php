@if($settings[0]->website_mode_store == '1')
<aside class="side-cart">
    <h3>Your Cart Items</h3>
    <p>lorem ipsum some thexasd asdss</p>
    <!-- cart items -->
    <ul class="side-cart__list">
        <li class="side-cart__item">
            <img src="https://dummyimage.com/50x50/ddd/000" alt="">
            <a href="product.php" title="Product Link">Product Name</a>
            <div class="product-available__items">
                <div class="available__items">
                    Cor:
                    <span class="item" data-color="black"></span>
                </div>
            </div>
            <div class="clearfix"></div>
            <form action="" method="post" class="cart-qty clearfix">
                <button class="cart-qty__btn qty-less" type="button">-</button>
                <input type="text" name="cart_quant" class="cart-qty__input">
                <button class="cart-qty__btn qty-plus" type="button">+</button>
                <a href="#" class="side-cart__del">eliminar</a>
            </form>
            <span class="cart-item__value">100€</span>
        </li>

        <li class="side-cart__item">
            <img src="https://dummyimage.com/50x50/ddd/000" alt="">
            <a href="product.php" title="Product Link">Product Name</a>
            <div class="product-available__items">
                <div class="available__items">
                    Cor:
                    <span class="item" data-color="black"></span>
                </div>
            </div>
            <div class="clearfix"></div>
            <form action="" method="post" class="cart-qty clearfix">
                <button class="cart-qty__btn qty-less" type="button">-</button>
                <input type="text" name="cart_quant" class="cart-qty__input">
                <button class="cart-qty__btn qty-plus" type="button">+</button>
                <a href="#" class="side-cart__del">eliminar</a>
            </form>
            <span class="cart-item__value">100€</span>
        </li>
        <li class="side-cart__item">
            <img src="https://dummyimage.com/50x50/ddd/000" alt="">
            <a href="product.php" title="Product Link">Product Name</a>
            <div class="product-available__items">
                <div class="available__items">
                    Cor:
                    <span class="item" data-color="black"></span>
                </div>
            </div>
            <div class="clearfix"></div>
            <form action="" method="post" class="cart-qty clearfix">
                <button class="cart-qty__btn qty-less" type="button">-</button>
                <input type="text" name="cart_quant" class="cart-qty__input">
                <button class="cart-qty__btn qty-plus" type="button">+</button>
                <a href="#" class="side-cart__del">eliminar</a>
            </form>
            <span class="cart-item__value">100€</span>
        </li>
        <li class="side-cart__item">
            <img src="https://dummyimage.com/50x50/ddd/000" alt="">
            <a href="product.php" title="Product Link">Product Name</a>
            <div class="product-available__items">
                <div class="available__items">
                    Cor:
                    <span class="item" data-color="red"></span>
                </div>
            </div>
            <div class="clearfix"></div>
            <form action="" method="post" class="cart-qty clearfix">
                <button class="cart-qty__btn qty-less" type="button">-</button>
                <input type="text" name="cart_quant" class="cart-qty__input">
                <button class="cart-qty__btn qty-plus" type="button">+</button>
                <a href="#" class="side-cart__del">eliminar</a>
            </form>
            <span class="cart-item__value">100€</span>
        </li>
    </ul>
    <!-- cart items ends -->
    <!-- cart items total -->
    <div class="side-cart__total">
        <div class="clearfix"></div>
        <span class="side-cart__total-total">
            Total
        </span>
        <span class="side-cart__total-value">
            200€
        </span>
    </div>
    <!-- cart items total ends -->
    <div class="clearfix"></div>
    <div class="side-cart__buttons">
        <a href="cart.php" title="Ir para o checkout" class="btn btn-primary">Ir para o checkout</a>
        <a href="#keepshopping" title="Fechar" class="btn btn-default">Fechar</a>
    </div>
</aside>
@endif