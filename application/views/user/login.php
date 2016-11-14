<section id="hero" class="login">
	<div class="container">
    	<div class="row">

        	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            	<div id="login">
                        <?php echo form_open('auth/do_login');?>
                        <div class="row">
                            <?php if($this->session->flashdata('alert')){
                                echo '<div class="alert alert-'.$this->session->flashdata('alert_level').'" role="alert">'.$this->session->flashdata('alert').'</div>';
                            }?>
                            <div class="page-header"><h2><?php echo $title;?></h2></div>
                            <div class="form-group">
                                <label>Username</label>
                                <?php echo form_input(['name' => 'username', 'placeholder' => 'Username', 'class' =>'form-control', 'required' => '']);?>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <?php echo form_password(['name' => 'password', 'placeholder' => 'Username', 'class' =>'form-control', 'required' => '']);?>
                            </div>
                            <p class="small">
                                <?php echo anchor('auth/forgot_password','Forgot password?', 'id="forgot_pw"');?>
                            </p>

                            <?php echo form_submit('btnSignIn','Sign in', 'class="btn btn-primary btn-block"');?>
                            <?php echo anchor('auth/register','Register','class="btn btn-default btn-block"');?>
                        <?php echo form_close();?>
                    </div>
            </div>
        </div>
    </div>
</section>
