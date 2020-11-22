<a href="<?=base_url()?>manager/nuevo_premio">
    <button type="button" class="btn btn-success">
            Agregar
    </button>
</a>
<br>
<br>
<table  class="table text-center" border="1">
    <thead>
        <tr>
            <th>award_id</th>
            <th>name_award</th>
            <th>name_img</th>
            <th>level</th>
            <th>status</th>
            <th>num_likes</th>
            <th>create_at</th>

        </tr>
    </thead>
    <tbody>
    <?php foreach ($awards->result() as $award): ?>
        <tr>
            <td><?=$award->award_id; ?></td>
            <td><?=$award->name_award; ?></td>
            <td>
                <img width="70" height="70" src="<?=base_url()?>assets/images/awards/<?=$award->name_img; ?>" alt="">
            </td>
            <td><?=$award->level; ?></td>
            <td>
                <input type="checkbox" data-award-id="<?=$award->award_id;?>" class="status_award" <?=($award->status==1)?"checked":""?>>
            </td>
            <td><?=$award->likes; ?></td>
            <td><?=$award->create_at; ?></td>
            
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>