
<div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
        <div class="stepwizard">
            <div class="stepwizard-row">
                <div class="stepwizard-step">
                    <?php echo anchor('orders/checkout','1','class="btn btn-success btn-circle"');?>
                    <p>Your Cart</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-primary btn-circle">2</button>
                    <p>Billing</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-default btn-circle">3</button>
                    <p>Payment</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-default btn-circle">4</button>
                    <p>Review & Purchase</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="page-header">
                <h2>Billing <small></small></h2>
            </div>
            <p>You can change the address of your order here. If it's different than your current address please check.</p>

            <?php
            if (validation_errors()){
                echo "<div class='alert alert-danger' role='alert'>".validation_errors()."</div>";
            }
            ?>
            <?php echo form_open();?>
            <?php
                $nama = $user->nama_depan.' '.$user->nama_belakang;
                $alamat = $user->alamat;
                $kota_id=  $user->kota_id;
                $provinsi_id=  $user->provinsi_id;
                if ($this->session->userdata('nama_penerima')){
                    $nama = $this->session->userdata('nama_penerima');
                    $alamat = $this->session->userdata('alamat_penerima');
                    $kota_id = $this->session->userdata('kota_penerima_id');
                    $provinsi_id = $this->session->userdata('provinsi_penerima_id');
                }

            ?>
            <div class="form-group">

                <label>Nama Penerima*</label>

                <?php echo form_input(['name'=>'nama_penerima','value'=> $nama,'class'=> 'form-control', 'required' => '']);?>
            </div>
            <div class="form-group">
                <label>Alamat Penerima*</label>
                <?php echo form_textarea(['rows'=>'3','name'=>'alamat_penerima','value'=> $alamat,'class'=> 'form-control', 'required' => '']);?>
            </div>
            <div class="form-group">
                <label>Provinsi Penerima*</label>
                <?php echo form_error('provinsi_id', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?php echo form_dropdown('provinsi_id',$dd_province, $provinsi_id,"class='form-control' id='provinsi_id'");?>
                <?php echo form_hidden('provinsi',$user->provinsi);?>
            </div>
            <div class="form-group">
                <label>Kota Penerima*</label>
                <?php echo form_error('city_id', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?php echo form_dropdown('city_id',$dd_city, $kota_id,"class='form-control' id='city_id'");?>
                <?php echo form_hidden('city',$user->kota);?>
            </div>
            <div class="pull-right">
                <?php echo form_submit('btnSubmit','Submit','class="btn btn-primary"');?>
            </div>
            <?php echo form_close();?>
        </div>
        <div class="col-md-4">
            <div class="page-header">
                <h3>Purchase Overview</h3>
            </div>
            <h4>Your items</h4>
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Detail</th>
                    <th>Qty</th>
                    <th class="text-right">Subtotal</th>
                </tr>
                <?php
                foreach ($this->cart->contents() as $product) {
                    $product_options = $this->cart->product_options($product['rowid']);
                    echo "<tr>";
                    echo "<td><img src='".base_url($product_options['gambar'])."' class='img' width='50'></td>";
                    echo "<td>".anchor('items/detail/'.$product['id'],$product['name']."(".$product_options['warna'].")")."<br>";
                    echo "IDR ".number_format($product['price'])."</td>";
                    echo "<td>".$product['qty']."</td>";
                    echo "<td class='text-right'>".number_format($product['subtotal'])."</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="3" class="text-right">Total :</td>
                    <td colspan="1" class="text-right">IDR <?php echo number_format($this->cart->total());?></td>
                </tr>
            </table>
        </div>


    </div>
</div>

<script>
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
