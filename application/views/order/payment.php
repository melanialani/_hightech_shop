
<div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
        <div class="stepwizard">
            <div class="stepwizard-row">
                <div class="stepwizard-step">
                    <?php echo anchor('orders/checkout','1','class="btn btn-success btn-circle"');?>
                    <p>Your Cart</p>
                </div>
                <div class="stepwizard-step">
                    <?php echo anchor('orders/billing','2','class="btn btn-success btn-circle"');?>
                    <p>Billing</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-primary btn-circle">3</button>
                    <p>Review & Purchase</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-default btn-circle">4</button>
                    <p>Confirm Payment</p>
                </div>
            </div>
        </div>
            <div class="page-header">
                <h3>Purchase Overview</h3>
            </div>
            <h4>Penerima </h4>
            <table class="table">
                <tr>
                    <th>
                        Nama:
                    </th>
                    <td>
                        <?php echo $this->session->userdata('nama_penerima');?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Alamat:
                    </th>
                    <td>
                        <?php echo $this->session->userdata('alamat_penerima');?><br>
                        <?php echo $this->session->userdata('kota_penerima').', '.$this->session->userdata('provinsi_penerima');?>
                    </td>
                </tr>
            </table>
            <h4>Your items</h4>
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Detail</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Subtotal</th>
                </tr>
                <?php
                foreach ($this->cart->contents() as $product) {
                    $product_options = $this->cart->product_options($product['rowid']);
                    echo "<tr>";
                    echo "<td><img src='".base_url($product_options['gambar'])."' class='img' width='100'></td>";
                    echo "<td>".anchor('items/detail/'.$product['id'],$product['name']."(".$product_options['warna'].")")."<br>";
                    echo "IDR ".number_format($product['price'])."</td>";
                    echo "<td class='text-right'>".$product['qty']."</td>";
                    echo "<td class='text-right'>".number_format($product['subtotal'])."</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="3" class="text-right">Total :</td>
                    <td colspan="1" class="text-right">IDR <?php echo number_format($this->cart->total());?></td>
                </tr>
                <?php echo form_open();?>
                <tr id="courier_options">
                    <th>Courier :</th>
                    <td>
                        <?php
                        if (validation_errors()){
                            echo "<div class='alert alert-danger' role='alert'>".validation_errors()."</div>";
                        }
                        ?>
                        <div class="row">
                        <div class="col-md-5 col-sm-5">
                            <select id="kode_kurir" name="kode_kurir" class="form-control">
                                <option value="jne"> JNE</option>
                                <option value="tiki"> Tiki</option>
                                <option value="pos"> Pos Indonesia</option>
                            </select>
                        </div>
                        <div class="col-md-7 col-sm-7"><?php echo form_hidden('service_kurir').form_hidden('voucher_id');?></div>
                        </div>
                        <div id="courier_cost" ></div>
                    </td>
                    <td class="text-right">Biaya Kirim:</td>
                    <td colspan="1" class="text-right">IDR 0</td>
                </tr>
                <tr id="voucher_options">
                    <th>Vouchers:</th>
                    <td>
                        <div class="row">
                            <div class="col-md-5 col-sm-5">
                                <?php echo form_input(['name' => 'voucher','class' => 'form-control','id' => 'voucher_id','placeholder' => 'Voucher Code']);?>
                            </div>
                            <div class="col-md-7 col-sm-7" >
                                <span id="voucher_button" class="btn-primary btn">Check </span>
                                <div id="voucher_check"></div>
                            </div>
                        </div>
                    </td>
                    <td class="text-danger text-right">Potongan Voucher</td>
                    <td class="text-danger text-right">(IDR 0)</td>

                </tr>
                <tr id="grand_total">
                    <td colspan="3" class="text-right"><h3>Grand Total :</h3></td>
                    <td class="text-right" style="vertical-align: middle">IDR <?php echo number_format($this->cart->total());?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right"></td>
                    <td class="text-right" style="vertical-align: middle"><?php echo form_submit('btnPurchase','Purchase Items','id="btnPurchase" class="btn btn-success pull-right"');?></td>
                </tr>
                <?php echo form_close();?>

            </table>


    </div>
</div>
<script>
    $(document).ready(function (){
        var grand_total = <?php echo round($this->cart->total(),0);?>;
        kode = $('#kode_kurir').val();
        var harga = 0;
        var voucher = 0;
        $('#btnPurchase').attr('disabled',true);

        $.post('<?php echo site_url('orders/getOngkirBarang');?>', {kode_kurir:kode}, function (data){
            $('#courier_cost').html(data);
            $('#courier_cost input[name="radio_service"]:first-child').attr('checked', true);
            harga = $('#courier_cost input[name="radio_service"]:first-child').attr('data-val');
            $('#courier_options input[name="service_kurir"]').val($('#courier_cost input[name="radio_service"]').val());
            temp = parseInt(grand_total) + parseInt(harga) - parseInt(voucher);
            $('#courier_options td:last-child').html('IDR '+number_format(harga));
            $('#grand_total td:last-child').html('IDR '+number_format(temp));
            $('#btnPurchase').removeAttr('disabled');
        });

        $('#kode_kurir').change(function(e){
            $('#btnPurchase').attr('disabled',true);
            kode = $('#kode_kurir').val();
            $.post('<?php echo site_url('orders/getOngkirBarang');?>', {kode_kurir:kode}, function (data){
                $('#courier_cost').html(data);
                $('#courier_cost input[name="radio_service"]:first-child').attr('checked', true);
                $('#courier_options input[name="service_kurir"]').val($('#courier_cost input[name="radio_service"]').val());
                harga = $('#courier_cost input[name="radio_service"]:first-child').attr('data-val');
                temp = parseInt(grand_total) + parseInt(harga) - parseInt(voucher);
                $('#courier_options td:last-child').html('IDR '+number_format(harga));
                $('#grand_total td:last-child').html('IDR '+number_format(temp));
                $('#btnPurchase').removeAttr('disabled');
            });
        });

        $('#courier_cost').on('change','input[name="radio_service"]',function(){
            $('#courier_options input[name="service_kurir"]').val($(this).val());
            harga = $(this).attr('data-val');
            temp = parseInt(grand_total) + parseInt(harga) - parseInt(voucher);
            $('#courier_options td:last-child').html('IDR '+number_format(harga));
            $('#grand_total td:last-child').html('IDR '+number_format(temp));
        });

        $('#voucher_button').click(function (){
            isi = $('#voucher_id').val();
            $.post('<?php echo site_url('orders/getVoucher');?>', {voucher_code:isi}, function (data){
                var arr = data.split('_');
                if (arr.length > 1){
                    voucher = arr[0];
                    temp = parseInt(grand_total) + parseInt(harga) - parseInt(voucher);
                    $('#courier_options input[name="voucher_id"]').val(isi);
                    $('#voucher_options td:last-child').html('( IDR '+number_format(voucher)+ ' )');
                    $('#grand_total td:last-child').html('IDR '+number_format(temp));
                    $('#voucher_check').html(arr[1]);
                }
                else{
                    voucher = 0;
                    $('#courier_options input[name="voucher_id"]').val('');
                    temp = parseInt(grand_total) + parseInt(harga) - parseInt(voucher);
                    $('#voucher_options td:last-child').html('( IDR '+number_format(voucher)+ ' )');
                    $('#grand_total td:last-child').html('IDR '+number_format(temp));
                    $('#voucher_check').html(arr[0]);
                }

            });
        });
    });

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec);
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '')
                .length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1)
                .join('0');
        }
        return s.join(dec);
    }
</script>

