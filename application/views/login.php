	
	<div class="row" style="width: 100%;">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				
				<div class="panel-heading">Log in</div>
				
				<div class="panel-body">
					<?php echo form_open('admin/login', "role='form'"); ?>
						<fieldset> 
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="">
							</div>
							
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							
							<div class="form-group">
								<input name="rememberMe" type="checkbox" value="1"> Remember Me
							</div>
							
							<?php echo form_submit(['id'=>'login','name'=>'login','value'=>'Login','class'=>'btn btn-primary']); ?>
						</fieldset> 
					<?php echo form_close(); ?>
				</div>
			</div>
			
			<?php echo $message; ?>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	