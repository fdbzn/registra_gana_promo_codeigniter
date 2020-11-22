<h2>Nuevo Ganador</h2>
<?= validation_errors(); ?>
<?=$error?>

<?php echo form_open_multipart('manager/nuevo_ganador');?>
    <div class="section_form">
        <label for="user_id">Id del usuario</label>
        <input type="number" name="user_id" id="user_id"  />
    </div>
    <div class="section_form">
        <label for="type_winner">Tipo de ganador</label>
        <select name="type_winner" id="type_winner" >
            <option value=""></option>
            <?php 
                $winner_types=[
                    1=>"Diario",
                    2=>"quincenal",
                    3=>"Gran premio",
                ];
            ?>
            <?php foreach($winner_types as $key=>$type):?>
                <option value="<?=$key?>"><?=$type?></option>
            <?php endforeach;?>
        </select>
    </div>
	
    <div class="section_form">
        <input type="submit" value="Guardar" />
    </div>
    
</form>

<hr>


<table i class="table text-center" border="1">
    <thead>
        <tr>
            <th scope="col">winner id</th>
            <th scope="col">User id</th>
            <th scope="col">name</th>
            <th scope="col">phone</th>
            <th scope="col">email</th>
            <th scope="col">type_winner</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($winners->result() as $user): ?>
        <tr>
            <td><?=$user->winner_id; ?></td>
            <td><?=$user->user_id; ?></td>
            <td><?=$user->name; ?></td>
            <td><?=$user->phone; ?></td>
            <td><?=$user->email; ?></td>
            <td><?=$winner_types[$user->type_winner]; ?></td>

            <td><button type="button" data-winner-id="<?php echo $user->winner_id?>" class="remove-winner btn btn-danger">Borrar</button></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
                            