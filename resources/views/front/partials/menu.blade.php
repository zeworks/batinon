<header>
		<div class="container">
			<div class="row matchheight">
				<div class="col-sm-2 col-xs-6" data-mh="height-menu">
					<!-- website logo -->
					<a class="logo-link" href="../" title>
						<img class="logo-image" src="../assets/img/LOGO_JUSTFORYOU.png" alt="">
					</a>
				</div>
				<div class="col-sm-10">
					<!-- menu links -->
					<ul class="menu hidden-xs">
            @if(count($urls) > 0 && count($menus) > 0)
              @foreach($menus as $menu)
                @foreach($urls as $url)
                  {{-- to main menus --}}
                  @if($url->position === 1 && $menu->id === 1)
                  <li class="menu__item">
                    <a href="../{{ $url->slug }}" title="{{$url->title}}" class="menu__item__link">{{$url->title}}</a>
                  </li>
                  @endif
                @endforeach
              @endforeach
            @endif
						@if($settings[0]->website_mode_store == '1')
						<li class="menu__item">
							<a href="login.php" title="User Account" class="menu__item__link menu__item__link--icon">
								<i class="fas fa-user"></i>
							</a>
						</li>
						<li class="menu__item">
							<a href="wishlist.php" title="Your Wishlist" class="menu__item__link menu__item__link--icon">
								<i class="fas fa-heart"></i>
							</a>
						</li>
						<li class="menu__item">
							<a href="#cartShopping" title="Cart Shopping" class="menu__item__link menu__item__link--icon cart-shopping">
								<i class="fas fa-shopping-cart">
									<span></span>
								</i>
							</a>
						</li>
						@endif
					</ul>
				</div>
				<div class="col-xs-6 hidden-sm hidden-md hidden-lg hidden-xl" data-mh="height-menu">
					<button type="button" class="btn-menu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					@if($settings[0]->website_mode_store == '1')
					<ul class="menu--mobile">
						<li class="menu__item">
							<a href="login.php" title="User Account" class="menu__item__link menu__item__link--icon">
								<i class="fas fa-user"></i>
							</a>
						</li>
						<li class="menu__item">
							<a href="wishlist.php" title="Your Wishlist" class="menu__item__link menu__item__link--icon">
								<i class="fas fa-heart"></i>
							</a>
						</li>
						<li class="menu__item">
							<a href="#cartShopping" title="Cart Shopping" class="menu__item__link menu__item__link--icon cart-shopping">
								<i class="fas fa-shopping-cart">
									<span></span>
								</i>
							</a>
						</li>
					</ul>
					@endif
					<!-- menu hamburger -->
				</div>
			</div>
		</div>
	</header>