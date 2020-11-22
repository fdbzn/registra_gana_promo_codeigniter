<script>
  gtag('event', 'conversion', {
    'allow_custom_scripts': true,
    'send_to': 'DC-6906608/tangq0/conve00+standard'
  });
</script>
<noscript>
<img src="https://ad.doubleclick.net/ddm/activity/src=6906608;type=tangq0;cat=conve00;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1?" width="1" height="1" alt=""/>
</noscript>

<script>
  fbq('track', 'CompleteRegistration');
</script>
<!-- End of event snippet: Please do not remove -->

<img class="logo" src="assets/images/logo.png" />

<div class="formulario">
	<p class="titulo text-center">REGISTRA TUS CÓDIGOS</p>
	<p class="subTitulo text-center">Introduce aquí tus códigos de nueve dígitos</p>
	<form class="row d-flex" id="codForm">
		<!-- <div id="codigos" class="container mt-3">
			<div class="col-12 my-auto labelForm pb-2">
				<input type="text" id="codigo1" name="codigo1" class="form-control codigo mx-auto" placeholder="000-000-000" maxlength="9" required >
			</div>
		</div> -->
		<div id="container_codes" class="container mt-3">
                    
		</div>  
		<div class="col-6 text-center">
			<img class="btn_enviar uno-mas" src="assets/images/btn_agregar.png" alt="Agregar" />
		</div>
		<div class="col-6 text-center">
			<input type="submit" value="enviar" class="btn_enviar" id="codigos_submit"/>
			<!-- <img class="btn_listo" src="assets/images/btn_listo.png" alt="Listo" onclick="validaCodigos();"> -->
		</div>
	</form>
</div>



<div id="row_new_code_clone" style="display: none" >
    <div class="row">
        <div class="col-12 vgoa-center labelForm pb-2">
            <input id="codigo" type="text" name="tang_code[]" class="tang-code form-control codigo"  maxlength="9" />
            <span id="delete-code-boton">x</span>
			<div class="error-tang-code error"></div>
		</div>
    </div>
</div>
