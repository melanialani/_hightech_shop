<div id="position" class='no_top'>
    <div class="container">
        <ul class="breadcrumb">
            <li><?php echo anchor('/','Home');?></li>
            <li><?php echo anchor('/profile','Profile');?></li>
            <li>User Profile</li>
        </ul>
    </div>
</div><!-- End Position -->
<section id="hero" class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div id="user_box">
                    <?php if($this->session->flashdata('alert')){
                        echo '<div class="alert alert-'.$this->session->flashdata('alert_level').'" role="alert">'.$this->session->flashdata('alert').'</div>';
                    }?>
                    <div class="text-left"><h4>Profile <?php echo anchor('profile/edit','<i class="icon-edit"></i>Edit','class="btn btn-primary btn-xs"');?></h4></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12"><b>Full Name</b></div>
                        <div class="col-md-8 col-sm-8 col-xs-12"><?php echo $user->nama_depan.' '.$user->nama_belakang;?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12"><b>Date of Birth </b></div>
                        <div class="col-md-8 col-sm-8 col-xs-12"><?php echo date_format(date_create_from_format('Y-m-d',$user->tanggal_lahir),'d M Y');?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12"><b>Address</b></div>
                        <div class="col-md-8 col-sm-8 col-xs-12"><?php echo $user->alamat.'<br>'.$user->kota.' ,'.$user->provinsi;?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12"><b>No. HP</b></div>
                        <div class="col-md-8 col-sm-8 col-xs-12"><?php echo $user->telepon;?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12"><b>Email</b></div>
                        <div class="col-md-8 col-sm-8 col-xs-12"><?php echo $user->email;?></div>
                    </div>
                    <div class="text-left"><h4>Change Your Password </h4></div>
                    <hr>
                    <?php echo form_open();?>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12"><b>Old Password</b></div>
                        <div class="col-md-8 col-sm-8 col-xs-12"><?php echo form_password(["name"=>"old_password","class" =>"form-control","maxlength"=>"15","required"=>""]);?>
                            <?php echo form_error('old_password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12"><b>New Password</b></div>
                        <div class="col-md-8 col-sm-8 col-xs-12"><?php echo form_password(["name"=>"new_password","class" =>"form-control","maxlength"=>"15","required"=>""]);?>
                            <?php echo form_error('new_password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12"><b>Confirm New Password</b></div>
                        <div class="col-md-8 col-sm-8 col-xs-12"><?php echo form_password(["name"=>"conf_password","class" =>"form-control","maxlength"=>"15","required"=>""]);?>
                            <?php echo form_error('conf_password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8"><?php echo form_submit('btnChangePassword','Change Password','class="btn btn-primary"');?></div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</section>