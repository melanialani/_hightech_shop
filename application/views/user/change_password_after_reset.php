<section id="hero" class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div id="login">
                    <div class="page-header"><h2>Reset Password</h2></div>
                    <?php echo form_open('');?>
                    <?php echo form_hidden('key',$key);?>
                    <div class="form-group">
                        <label>New Password</label>
                        <?php echo form_error('password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_password([ "name" => "password","class"=>"form-control","placeholder" => 'Password',"required" => '',"id"=>'inputPassword',"minlength"=>6, "maxlength" => 15]);?>

                    </div>
                    <div class="form-group">
                        <label>Confirm password</label>
                        <?php echo form_error('conf_password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_password([ "name" => "conf_password","class"=>"form-control","placeholder" => 'Confirm Password',"required" => '',"minlength"=>6,"maxlength"=>15]);?>
                    </div>
                    <div id="pass-info" class="clearfix"></div>
                    <?php echo form_submit('btnChangeReset', 'Change Password', 'class="btn btn-primary btn-block"');?>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</section>