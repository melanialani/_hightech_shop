<link href="<?php echo base_url('assets/css/date_time_picker.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/bootstrap-helper/css/bootstrap-formhelpers.min.css');?>" rel="stylesheet">

<section id="hero" class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div id="login">
                    <?php if($this->session->flashdata('alert')){
                        echo '<div class="alert alert-'.$this->session->flashdata('alert_level').'" role="alert">'.$this->session->flashdata('alert').'</div>';
                    }?>
                    <div class="text-center"><h4>Edit Profile</h4></div>
                    <hr>
                    <?php echo form_open_multipart('profile/edit');?>
                    <div class="form-group">
                        <label>First Name</label>
                        <?php echo form_error('first_name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_input(['name' => 'first_name', 'placeholder' => 'First Name', 'class' =>'form-control', 'required' => '', 'value' => $user->nama_depan,'maxlength'=>50]);?>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <?php echo form_error('last_name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_input(['name' => 'last_name', 'placeholder' => 'Last Name', 'class' =>'form-control', 'required' => '', 'value' => $user->nama_belakang,'maxlength'=>50]);?>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <?php echo form_error('tanggal_lahir', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_input(['name' => 'tanggal_lahir', 'class' => 'date-pick form-control', 'data-date-format'=> 'dd/mm/yyyy']);?>
                    </div>
                    <div class="form-group">
                        <label>Telephone</label>
                        <?php echo form_error('telepon', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_input(['name' => 'telepon', 'placeholder' => 'Telephone', 'class' =>'form-control bfh-phone', 'data-format'=>"+62 ddd dddd dddd", 'required' => '', 'value' => $user->telepon,'maxlength'=>25]);?>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <?php echo form_error('address', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_input(['name' => 'address', 'placeholder' => 'Address', 'class' =>'form-control', 'required' => '', 'value' => $user->alamat,'maxlength'=>255]);?>
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <?php echo form_error('provinsi_id', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_dropdown('provinsi_id',$dd_province, $user->provinsi_id,"class='form-control' id='provinsi_id'");?>
                        <?php echo form_hidden('provinsi',$user->provinsi);?>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <?php echo form_error('city_id', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?php echo form_dropdown('city_id',$dd_city, $user->kota_id,"class='form-control' id='city_id'");?>
                        <?php echo form_hidden('city',$user->kota);?>
                    </div>
                    <?php echo form_submit('btnEditProfile','Save Changes', 'class="btn btn-block btn-primary"');?>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js');?>"></script>
<script src="<?php echo base_url('assets/bootstrap-helper/js/bootstrap-formhelpers.min.js');?>"></script>
<script>
    $('input.date-pick').datepicker('setDate', '<?php echo date_format(date_create_from_format('Y-m-d',$user->tanggal_lahir),'d/m/Y');?>');
    $('#provinsi_id').change(function(e){
        $('input[name="provinsi"]').val($('#provinsi_id option:selected').text());
        var nilai_id = $('#provinsi_id').val();
        $('#city_id').attr('disabled','');
        $.post('<?php echo site_url('profile/getCity');?>',{province_id:nilai_id}, function (data){
            $('#city_id').html(data);
            $('#city_id').removeAttr('disabled');
        });
    });
    $('#city_id').change(function(e){
        $('input[name="city"]').val($('#city_id option:selected').text());
    });
</script>
