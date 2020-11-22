
<script>

fbq('track', 'Search');

</script>

<img class="logo" src="<?=base_url()?>assets/images/logo.png" />
	<div class="formulario">
	<p class="subTitulo text-center">¡Haz click sobre la imagen para votar por el premio que te gustaría ganar!</p>
	<img class="quincenal premio-quincenal-boton" src="<?=base_url()?>assets/images/premio_quincenal.png" />
	<div class="row premios">
		<?php foreach($awards->result() as $key=>$award):?>
			<?php $style_paloma="display:none"?>
			<?php foreach($my_awards->result() as $my_award):?>
				<?php if($my_award->award_id == $award->award_id){$style_paloma = "";}  ?>
			<?php endforeach; ?>
		
			<div data-award-id="<?=$award->award_id?>" class="award_btn col-6 cont_premio_<?=$key+1?> text-center " >
				<img class="premio_1" src="<?=base_url()?>assets/images/awards/<?=$award->name_img?>" />
				<div class="name-award"><?=$award->name_award?></div>
				<img class="icon_premio_1" src="<?=base_url()?>assets/images/icon_voto.png" style="<?=$style_paloma?>" />
				<p><hr class="barra_1" /></p>
				<p class="totVotos">
					<span class="counter_likes">
						<?=$award->likes?>
					</span>
					votos
				</p>
			</div>
		<?php endforeach; ?>
	</div>
  <div class="slick row premio_mayor">
        <div class="slide">
          <p class="subTitulo mx-auto text-center">¡Además,  sigue participando por premios diarios, quincenales y el gran premio!</p>
          <img class="jaime_100k" src="assets/images/premio_jaime.png" />
        </div>
		<div class="slide">
		  <p class="subTitulo mx-auto text-center">¡Además,  sigue participando por premios diarios, quincenales y el gran premio!</p>
		  <img class="jaime_100k" src="assets/images/awards/slidepremio4.png" />
		</div>
		<div class="slide">
		  <p class="subTitulo mx-auto text-center">¡Además,  sigue participando por premios diarios, quincenales y el gran premio!</p>
		  <img class="jaime_100k" src="assets/images/awards/slidepremio3.png" />
		</div>
		<div class="slide">
		  <p class="subTitulo mx-auto text-center">¡Además,  sigue participando por premios diarios, quincenales y el gran premio!</p>
		  <img class="jaime_100k" src="assets/images/awards/slidepremio2.png" />
		</div>
        <div class="slide">
          <p class="subTitulo mx-auto text-center">¡Además,  sigue participando por premios diarios, quincenales y el gran premio!</p>
          <img class="jaime_100k" src="assets/images/awards/slidepremio1.png" />
        </div>
      </div>
</div>