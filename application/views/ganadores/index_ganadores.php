<style>
.subTitulo {
    font-size: 28pt;
    font-weight: bold;
    color: #388244;
}
</style>


<img class="logo" src="<?=base_url()?>assets/images/logo.png" />
<br>

<?php 
    $winner_types=[
        1=>"Premio Diario",
        2=>"Premio Quincenal",
        3=>"Gran premio",
    ];
    ?>

<div class="formulario scroll_container">
        <table i class="table text-center ganadores_table" >
        
            <tbody>
                
                <?php foreach ($winners->result() as $key=>$user): ?>
                    <tr>
                        <td><?=$user->name; ?></td>
                        <td><?=$user->last_name; ?></td>
                        <td><?=$winner_types[$user->type_winner]; ?></td>               
                        <td><?=$user->description; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
</div>
                            