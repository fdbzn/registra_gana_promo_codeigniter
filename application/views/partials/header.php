<input type="hidden" value="<?=base_url()?>" id="base_url">
<div id="scene">
<?php if(!validate_session()): ?>
    <img class="btn_inicia_session" src="<?=base_url()?>assets/images/btn_inicia_session.png" data-toggle="" data-target="" />
<?php endif;?>
<div class="btn_menu"  style="display:none" onclick="openNav()">
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
</div>

<div id="mySidebar" class="sidebar">
    
    <a class="text-center py-4 inicio-boton" href="<?php echo(base_url()); ?>">Inicio</a>
    <a class="text-center py-4 perfil-boton" href="<?php echo(base_url()); ?>">Mi perfil</a>
    <a class="text-center py-4 mecanica-boton" href="<?php echo(base_url()); ?>">Mecánica</a>
    <a class="text-center py-4 registra-boton" href="<?php echo(base_url()); ?>" id="">Registra tus códigos</a>
    <a class="text-center py-4 premios-boton" href="<?php echo(base_url()); ?>">Premios</a>
    <a class="text-center py-4 premios-boton" href="<?php echo(base_url()); ?>">Premio ganador</a>
    <a class="text-center py-4 contacto-boton" href="<?php echo(base_url()); ?>">Contacto</a>
    <a class="text-center py-4 contacto-boton" href="<?php echo(base_url('ganadores')); ?>">Ganadores</a>
    <?php if(validate_session()): ?>
        <a class="text-center py-4 face-boton" href="<?php echo(base_url('login/logout')); ?>">Cerrar sesión</a>
    <?php endif;?>
    <a class="text-center py-4" href="https://es-la.facebook.com/TangMexico/" target="_blank"><i class="fa fa-facebook"></i></a>

   
</div>