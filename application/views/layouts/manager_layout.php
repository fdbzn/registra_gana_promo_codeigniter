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

	</head>
	<body >
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJ9FFRL"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<input type="hidden" value="<?=base_url()?>" id="base_url">

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Tang</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="<?=base_url()?>manager">Reportes </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>manager/premios">Premios</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>manager/buscarUsuario">Buscar Usuario</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>manager/nuevo_ganador">Ganadores</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>manager/buscar_codigo">Códigos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>manager/reset_password">Reset password</a>
				</li>
				
				</ul>
				
			</div>
		</nav>
		<div class="container" id="main_container">
		
			<?=$content?>
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>


		<script src="<?php echo(base_url('assets/js/Config.js?rel='.uniqid())); ?>"></script>
        <script src="<?=base_url()?>assets/js/message.js"></script>
		<script src="<?php echo(base_url('assets/js/main.js?rel='.uniqid())); ?>"></script>
		
		<?php if(isset($scriptsJS)): ?>
			<?=loadJS($scriptsJS)?>
		<?php endif;?>
	</body>
</html>














