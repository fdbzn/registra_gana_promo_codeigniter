<img class="logo" src="assets/images/logo.png" />
		
<div class="formulario">
	<p class="text-center"><img class="user_icon" src="assets/images/user_she.png" /></p>
	<p class="titulo text-center">¡Hola <?=$user_data->name?>!</p>
	<!-- <p class="subTitulo text-center">Tienes {totPuntos} puntos</p> -->
	<p class="subTitulo text-center">Has registrado <?=$num_codes?> códigos</p>
	<p class="subTitulo text-center">
		<?php if(!empty($user_data->bonnus_url)): ?>
			Tienes 1 premio instantaneo:
			<a href="<?=$user_data->bonnus_url?>" target="_blank">Ver aquí</a> 
		<?php endif;?>
	</p>
		
	<form class="row d-flex">
		<div class="col-12 text-center">
			<img class="btn_enviar perfil-registra-codigos-boton" src="assets/images/btn_registra_tus_codigos.png" alt="Iniciar" onclick="self.location.href='<?php echo(base_url('codigos')); ?>';" >
		</div>
	</form>
</div>