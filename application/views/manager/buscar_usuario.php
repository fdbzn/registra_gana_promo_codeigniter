<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
           <div class="user-search-form">
               <form action="<?=base_url()?>manager/buscarUsuario" id="manager-user-search" class="form-inline"  method="POST">
                    <div class="col-8">
                        <div class="form-group">
                            <input type="email" class="form-control w-100" name="mail" id="mail" placeholder="Correo del Usuario">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary w-100" value="Buscar">
                        </div>
                    </div>
                </form>
           </div>
        </div>
      
    </div>
    <?php if(isset($users)): ?>


       <div class="row justify-content-center">
            <div class="col-12 col-md-8">
            <?php if(!empty($users->num_rows())):?>

            <table id="" class="table text-center mt-5" border="1">
                <thead>
                    <tr>
                    <th scope="col">user_id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">origen</th>
                    <th scope="col">phone</th>
                    <th scope="col">Bonnus url</th>
                    </tr>
                </thead>
                <tbody>
                <?php  $results = $users->result();
                    foreach ($results as $user): ?>
                        <tr>
                            <td><?php echo $user->user_id?></td>
                            <td><?php echo $user->name?></td>
                            <td><?php echo $user->email?></td>
                            <td><?php echo $user->origin?></td>
                            <td><?php echo $user->phone?></td>
                            <td><?php echo $user->bonnus_url?></td>
                        </tr>
                        </tbody>
                    </table>
                <?php endforeach ?>
            <?php else: ?>
                <div  class="alert alert-danger mt-5 text-center" role="alert">
                    No hay resultados para tu búsqueda.
                </div>
            <?php endif ?>
            </div>
        </div>

        <?php else: ?>
      <div class="row justify-content-center">
          <div class="col-12 col-md-8">
            <div  class="alert alert-warning mt-5 text-center" role="alert">
                Por favor ingresa un correo para realizar una busqueda.
            </div>
          </div>
      </div>
           
        <?php endif?>
</div>