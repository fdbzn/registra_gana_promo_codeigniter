<!DOCTYPE html>
<html lang="es">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
		<meta name="google-site-verification" content="2-jV3jwFuY30V2ZaJ7qXy_v0D4eZ8Tira0PVR8FodVM" />

		<meta http-equiv="expires" content="-1" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="cache-control" content="no-store" />
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		
		<link rel="icon" href="favicon.ico">
		
		<?php if (isset($metadata)): ?>
			<!-- specific metadata -->
			<?php load_partial("partials/metadata", $metadata);?>
			<?php else:?>
			<title>Con Tang</title>			
		<?php endif;?>
		<?php if (isset($metaFb)): ?>
			<!-- facebook metadata -->
			<?php load_partial("partials/metaFb", $metaFb);?>
		<?php endif;?>
		
		
		<?php if(isset($scriptsCSS)): ?>
			<?=loadCSS($scriptsCSS)?>
		<?php endif;?>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo(base_url('assets/css/Main.css?rel='.uniqid())); ?>">
		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-NJ9FFRL');</script>
		<!-- End Google Tag Manager -->

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154880953-5"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-154880953-5');
		</script>


		<!-- 
		Start of global snippet: Please do not remove
		Place this snippet between the <head> and </head> tags on every page of your site.
		-->
		<!-- Global site tag (gtag.js) - Google Marketing Platform -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=DC-6906608"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'DC-6906608');
		</script>
		<!-- End of global snippet: Please do not remove -->


		<!-- Facebook Pixel Code -->

		<script>

		!function(f,b,e,v,n,t,s)

		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?

		n.callMethod.apply(n,arguments):n.queue.push(arguments)};

		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';

		n.queue=[];t=b.createElement(e);t.async=!0;

		t.src=v;s=b.getElementsByTagName(e)[0];

		s.parentNode.insertBefore(t,s)}(window,document,'script',

		'https://connect.facebook.net/en_US/fbevents.js');

		fbq('init', '284917849333508');

		fbq('track', 'PageView');

		</script>

		<noscript>

		<img height="1" width="1"

		src="https://www.facebook.com/tr?id=284917849333508&ev=PageView

		&noscript=1"/>

		</noscript>

		<!-- End Facebook Pixel Code -->
	</head>
	<body >
	 
		<div class="pop-container pop-container-visible">
			<div class="popimg">
				<a href="#"><img src="/img/popbanner.png" alt=""></a>
				<div class="close-boton">
				<div class="line"></div>
				<div class="line"></div>
				</div>  
			</div>
		</div>
		
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJ9FFRL"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<?php load_partial("/partials/header")?>
			<?=$content?>
			<?php load_partial("partials/footer")?>
		</div>
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script
		src="https://code.jquery.com/jquery-3.4.1.min.js"
		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
		crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.5.9/lottie.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="<?=base_url()?>assets/js/Global.js?rel=5ce4840e4c040"></script>
		<script src="<?php echo(base_url('assets/js/jquery.formatter.min.js')); ?>"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
		
		<script src="<?php echo(base_url('assets/js/Config.js?rel='.uniqid())); ?>"></script>
        <script src="<?=base_url()?>assets/js/message.js"></script>
		<script hola=""  src="<?php echo(base_url('assets/js/main.js?rel='.uniqid())); ?>"></script>
		
		<?php if(isset($scriptsJS)): ?>
			<?=loadJS($scriptsJS)?>
		<?php endif;?>
	</body>
</html>














