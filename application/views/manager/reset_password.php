<div class="col-12">
    <div class="row justify-content-center align-items-center mt-5">
        <form action="<?=base_url()?>manager/reset_password" method="POST">
            <div class="form-group">
                <label for="f_email">email</label>
                <input class="form-control" name="f_email" value="<?=$email?>" id="f_email" type="text">
                <label for="f_pass">nuevo password</label>
                <input class="form-control" name="f_pass" id="f_pass" type="text">
            </div>
                <input type="submit" class="mt-2 btn btn-primary">
        </form>
    </div>
    <?php if($success):?>
        <div class="row col-12 justify-content-center align-items-center mt-5 ">
            <div class="alert alert-info col-8" role="alert">
                Password actualizado
            </div>
        </div>
        <?php else:?>
            <div class="row col-12 justify-content-center align-items-center mt-5 ">
                <div class="alert alert-warning col-8" role="alert">
                    No actualizado
                </div>
            </div>
    <?php endif ?>
</div>
