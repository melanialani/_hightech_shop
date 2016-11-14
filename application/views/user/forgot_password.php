<section id="hero" class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div id="login">
                    <?php echo form_open();?>
                    <div class="page-header"><h2>Forgot Password</h2></div>
                    <?php if($this->session->flashdata('alert')){
                        echo '<div class="alert alert-'.$this->session->flashdata('alert_level').'" role="alert">'.$this->session->flashdata('alert').'</div>';
                    }?>
                    <p>We need your account's email address if you wish to reset your password.</p>
                    <div class="form-group">
                        <?php echo form_error('reset_email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_input(['name' => 'reset_email', 'placeholder' => 'Email Address', 'class' =>'form-control', 'required' => '', 'value' => set_value('reset_email','')]);?>
                    </div>
                    <?php echo form_submit('btnResetPassword','Reset Password', 'class="btn btn-primary btn-block"');?>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</section>
