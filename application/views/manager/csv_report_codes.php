
<table i class="table text-center" border="1">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">email</th>
            <th scope="col">code</th>
            <th scope="col">origin</th>
            <th scope="col">create_at</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users->result() as $user): ?>
        <tr>
            <td><?=$user->user_id; ?></td>
            <td><?=mb_convert_encoding($user->email, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=$user->code; ?></td>
            <td><?=$user->origin; ?></td>
            <td><?=mb_convert_encoding($user->create_at, 'UTF-16LE', 'UTF-8')?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
                            