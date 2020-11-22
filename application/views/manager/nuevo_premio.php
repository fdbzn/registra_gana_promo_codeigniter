<h2>Nuevo Premio</h2>
<?= validation_errors(); ?>
<?=$error?>

<?php echo form_open_multipart('manager/nuevo_premio');?>
    <div class="section_form">
        <label for="img_award">Imagen</label>
        <input type="file" name="img_award" id="img_award"  />
    </div>
    <div class="section_form">
        <label for="name_award">Nombre</label>
        <input type="text" name="name_award" id="name_award" />
    </div>
    <div class="section_form">
        <label for="nivel_award">Fase</label>
        <select name="nivel_award" id="nivel_award" >
            <option value="">Fase</option>
            <?php for($i=1; $i<=10; $i++):?>
                <option value="<?=$i?>">Fase <?=$i?></option>
            <?php endfor?>
        </select>
    </div>
	
    <div class="section_form">
        <input type="submit" value="Crear premio" />
    </div>
    
</form>