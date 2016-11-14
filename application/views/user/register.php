<script src='https://www.google.com/recaptcha/api.js'></script>
    <section id="hero" class="login">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                	<div id="login">
                    		<div class="page-header"><h2>Register</h2></div>
                        <?php if($this->session->flashdata('alert')){
                            echo '<div class="alert alert-'.$this->session->flashdata('alert_level').'" role="alert">'.$this->session->flashdata('alert').'</div>';
                        }?>
							<?php echo form_open('',['id'=>"register_form"]);?>
                                <div class="form-group">
                                	<label>Username</label>
									<?php echo form_error('username', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
									<?php echo form_input(["name"=>'username', "class" => "form-control","placeholder" => 'Username', "required" => "", "maxlength" => 15, "id" => "f_username", "value" => set_value('username', '')]);?>
                                </div>
                                <div class="form-group">
                                	<label>Email</label>
									<?php echo form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    <?php echo form_input(["name" => "email","class" => "form-control", "type"=>"email", "placeholder" => 'Email', "required" => "", "value" => set_value('email', '') ]); ?>
									<div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                	<label>Password</label>
									<?php echo form_error('password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                     <?php echo form_password([ "name" => "password","class"=>"form-control","placeholder" => 'Password',"required" => '',"id"=>'inputPassword',"minlength"=>6, "maxlength" => 15]);?>

                                </div>
                                <div class="form-group">
                                	<label>Confirm password</label>
									<?php echo form_error('conf_password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
									<?php echo form_password([ "name" => "conf_password","class"=>"form-control","placeholder" => 'Confirm Password',"required" => '',"minlength"=>6,"maxlength"=>15]);?>
                                </div>

                                <div id="pass-info" class="clearfix"></div>
                        <div class="g-recaptcha" data-sitekey="6Lfz6-8SAAAAAH1IhbBC8zmNgD5oNx7WWX2hPL6t"></div>
                                <?php echo form_checkbox(['name'=>'agreeTerms','value'=>'agree']);?> By signing up to this site, I agree to the Terms and Conditions of this site.<br/><br/>
                                <?php echo form_error('agreeTerms', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?php echo form_submit('btnRegister', 'Create an account', 'class="btn btn-primary btn-block"');?>

                            <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </section>