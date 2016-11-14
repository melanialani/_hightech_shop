<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title;?> | High Tech Shop </title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/jquery-ui.min.css')?>" rel="stylesheet">
	
    <script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.min.js')?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo  site_url()?>"><img height="30" style='margin-top:-5px;' src="<?php echo base_url('assets/images/simple_logo.png');?>"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Browse <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><?php echo anchor('items/browse/','All', 'id="browse_all"');?></li>
                        <li class="divider"></li>
						<?php
						foreach($this->barang_model->getCategories() as $cat){
							$nm = $cat->nama; $id = $cat->id;
							echo "<li>". anchor("items/browse?categorydd=$id","$nm", "id='browse_$nm'")."</li>";
						}
						?>
                    </ul>
                </li>
                <li><?php echo anchor('items/compare','Compare', 'id="compare"');?></li>
                <li><?php echo form_open('items/browse', ['method'=>'GET','class' => "navbar-form navbar-left", 'role' => 'search']);?>
                    <input name="srcTxt" type="text" id="srcTxt" class="form-control " placeholder="Search Items">
					<?php echo form_submit('srcBtn', 'Search', "class='btn btn-primary'");?>
					<?php echo form_close()?>
				</li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li >
                        <?php
                        if (!$this->session->userdata('p_username')) {
                            ?>

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="access_link">Sign
                                in</a>

                            <ul class="dropdown-menu" id="login_form">
                                <?php echo form_open('auth/do_login');?>
                                <div class="form-group">
                                    <?php echo form_input(["name" => 'username', "class" => "form-control", "id" => "inputUsernameEmail", "placeholder"=>"Email"]);?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_password(["name" => "password", "class" => "form-control", "placeholder" => "Password", "id" => "inputPassword"]);?>
                                </div>
                                <?php echo anchor('auth/forgot_password','Forgot password?', 'id="forgot_pw"');?>
                                <?php echo form_hidden('current_url', uri_string());?>
                                <?php echo form_submit(["name"=>"btnSignIn", "class" => "btn btn-primary", "value"=>"Sign In"]);?>
                                <?php echo anchor('auth/register','Sign Up','class="btn btn-default"');?>
                                <?php echo form_close();?>
                            </ul>

                        <?php
                        }
                        else { ?>

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="access_link">  <?php echo $this->session->userdata('p_username');?></a>
                            <ul class="dropdown-menu">
                                <li><?php echo anchor('profile','Profile');?></li>
                                <li><?php echo anchor('profile/order','My Order');?></li>
                                <li role="separator" class="divider"></li>
                                <li><?php echo anchor('profile/do_logout','Log out');?></li>
                            </ul>
                        <?php
                        }
                        ?>

                </li>
                <li id="shopping_link">

                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
<?php if($this->session->flashdata('alert_con')){
    echo '<div class="alert alert-'.$this->session->flashdata('alert_con_level').'" role="alert">'.$this->session->flashdata('alert_con').'</div>';
}?>