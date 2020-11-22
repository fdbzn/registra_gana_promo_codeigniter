
<table i class="table text-center" border="1">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">name</th>
            <th scope="col">last_name</th>
            <th scope="col">second_last_name</th>
            <th scope="col">age</th>
            <th scope="col">email</th>
            <th scope="col">state</th>
            <th scope="col">city</th>
            <th scope="col">sex</th>
            <th scope="col">tsp</th>
            <th scope="col">phone</th>
            <th scope="col">origin</th>
            <th scope="col">token</th>
            <th scope="col">bonnus_id</th>
            <th scope="col">bonnus_url</th>
            <th scope="col">create_at</th>
            <th scope="col">num_codes</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users->result() as $user): ?>
        <tr>
            <td><?=$user->user_id; ?></td>
            <td><?=mb_convert_encoding($user->name, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->last_name, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->second_last_name, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->age, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->email, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->state, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->city, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->sex, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->tsp, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->phone, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->origin, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->token, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->bonnus_id, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->bonnus_url, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=mb_convert_encoding($user->create_at, 'UTF-16LE', 'UTF-8')?></td>
            <td><?=$user->num_codes; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
                            