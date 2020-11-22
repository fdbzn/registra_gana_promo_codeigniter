
<!--
Event snippet for CONVERSION_CLICK_LOG-IN-TANGQUIEROMAS_COUNTER_MX on https://contangquieromas.com/: Please do not remove.
Place this snippet on pages with events you’re tracking. 
Creation date: 05/14/2020
-->
<script>
  gtag('event', 'conversion', {
    'allow_custom_scripts': true,
    'send_to': 'DC-6906608/tangq0/conve0+standard'
  });
</script>
<noscript>
<img src="https://ad.doubleclick.net/ddm/activity/src=6906608;type=tangq0;cat=conve0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1?" width="1" height="1" alt=""/>
</noscript>
<!-- End of event snippet: Please do not remove -->

<!--
Event snippet for CONVERSION_PAGE VIEW_HOME-TANGQUIEROMAS_COUNTER_MX on https://contangquieromas.com/: Please do not remove.
Place this snippet on pages with events you’re tracking. 
Creation date: 05/14/2020
-->
<script>
  gtag('event', 'conversion', {
    'allow_custom_scripts': true,
    'send_to': 'DC-6906608/tangq0/conve000+standard'
  });
</script>
<noscript>
<img src="https://ad.doubleclick.net/ddm/activity/src=6906608;type=tangq0;cat=conve000;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1?" width="1" height="1" alt=""/>
</noscript>

<script>


</script>
<!-- End of event snippet: Please do not remove -->

  <!-- <img class="logo_promo" id="monedas" src="assets/images/huelesamoneda.gif" /> -->
  <div class="btn_compra" id="lottie1"></div>
  <div class="btn_registra" id="lottie2"></div>
  <div class="btn_gana" id="lottie3"></div>
	
	<img class="btn_como_participar" src="assets/images/btn_como_participar.png"/>
	<img class="btn_registra_codigos" src="assets/images/btn_registra_codigos.png"/>
	
	<div class="row premios home_premios">
		<?php foreach($awards->result() as $key=>$award):?>
			<div class="col-12 cont_premio_<?=$key+1?> text-center">
				<img class="premio_1" src="assets/images/awards/<?=$award->name_img?>" />
				<p><hr class="barra_1" /></p>
				<p class="totVotos"><?=$award->likes?> votos</p>
			</div>
			
		<?php endforeach; ?>
	</div>



			