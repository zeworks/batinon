<!DOCTYPE html>
<html lang="pt">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Website theme color -->
	<meta name="theme-color" content="#F1E3DD">
	
	<!-- Website desc -->
	<title>{{$settings[0]->website_name}} @yield('page_title')</title>
	<meta name="description" content="{{$settings[0]->website_desc}}">
	<meta name="keywords" content="">

	<!-- Facebook meta tags -->
	<meta property="og:title" content="">
	<meta property="og:description" content="">
	<meta property="og:site_name" content="">
	<meta property="og:url" content="{{ $settings[0]->website_url_facebook }}">
	<meta property="og:type" content="website">
	<meta property="og:image" content="">

	<!-- Twitter meta tags -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@site_account">
	<meta name="twitter:creator" content="@individual_account">
	<meta name="twitter:url" content="http://example.com/page.html">
	<meta name="twitter:title" content="Content Title">
	<meta name="twitter:description" content="Content description less than 200 characters">
	<meta name="twitter:image" content="http://example.com/image.jpg">

	<!-- Google Plus meta tags -->
	<link href="https://plus.google.com/+YourPage" rel="publisher">
	<meta itemprop="name" content="Content Title">
	<meta itemprop="description" content="Content description less than 200 characters">
	<meta itemprop="image" content="http://example.com/image.jpg">

	<link rel="dns-prefetch" href="https://ssl.google-analytics.com/">
	<link rel="dns-prefetch" href="//connect.facebook.net">

	<!-- Website icons -->
	<link href="{{asset('assets/img/favicon-192x192.png')}}" rel="icon" sizes="192x192">
	<link href="{{asset('assets/img/favicon-180x180.png')}}" rel="apple-touch-icon" sizes="180x180">

	<!-- Font Awesome icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
	    crossorigin="anonymous">

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('assets/vendor.min.css') }}">
	<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
	<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
	<!-- endinject -->
</head>

<body>
	<!-- header -->
	@include('front.partials.menu', ['urls' => $urls, 'settings' => $settings, 'menus' => $menus])

	<main>
		@yield('content')
	</main>
	
	@include('front.partials.sidecart', ['settings' => $settings])
	
	@include('front.partials.footer', ['urls' => $urls, 'menus' => $menus])

	@include('front.partials.loading')

	<!-- Cookies -->
	<div class="cookies-bar">
		<div class="cookies-bar-inner clearfix">
			<h4>Política de Cookies</h4>
			<div class="cookies-bar-message">Os cookies ajudam-nos a oferecer os nossos serviços. Ao utilizar os nossos serviços, concorda com a nossa utilização de
				cookies.
			</div>
			<div class="cookies-bar-buttons">
				<a href="" rel="nofollow" class="cookies-bar-know-more btn btn-default" title="" target="_blank">Saiba mais</a>
				<a href="" rel="nofollow" class="cookies-bar-accept btn btn-primary" title="" id="removecookie">Aceito</a>
			</div>
		</div>
	</div>
	<!-- Cookies ends -->
	<?php define('LOCAL', 'local'); ?>
	<?php if ( LOCAL != 'local' ) { ?>
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=<?php echo LANG; ?>" async
	    defer></script>
	<script>
		var sitekey = <?php echo BO_RECAPTCHA_SITEKEY; ?>;
	</script>
	<?php } ?>
	<script id="dsq-count-scr" src="//teste-j3wyksvwj1.disqus.com/count.js" async></script>
	<script src="{{ asset('assets/vendor.min.js') }}" defer></script>
	<script src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js" defer></script>
	<script src="{{ asset('assets/js/app.js') }}" defer></script>
</body>

</html>