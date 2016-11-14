
<div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
        <div class="stepwizard">
            <div class="stepwizard-row">
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-success btn-circle">1</button>
                    <p>Your Cart</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-success btn-circle">2</button>
                    <p>Billing</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-success btn-circle">3</button>
                    <p>Review & Purchase</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-primary btn-circle">4</button>
                    <p>Confirm Payment</p>
                </div>
            </div>
        </div>
        <div class="page-header">
            <h3><?php echo $title;?></h3>
        </div>
        <h4>Order Tracking</h4>
        <table class="table table-bordered">
            <tr>
                <th>Tanggal</th>
                <th>Status Order</th>
            </tr>
            <?php
            foreach ($order['log'] as $log){
                echo "<tr>";
                echo "<td>".$log['tanggal']."</td>";
                echo "<td>".$log['status']."</td>";
                echo "</tr>";
            }?>

        </table>
        <h4>Penerima </h4>
        <table class="table table-bordered">
            <tr>
                <th>
                    Nama:
                </th>
                <td>
                    <?php echo $order['nama'];?>
                </td>
            </tr>
            <tr>
                <th>
                    Alamat:
                </th>
                <td>
                    <?php echo $order['alamat'];?>
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
            foreach ($order['products'] as $product) {
                echo "<tr>";
                echo "<td><img src='".base_url($product['gambar'])."' class='img' width='100'></td>";
                echo "<td>".anchor('items/detail/'.$product['id'],$product['name']."<br>");
                echo "IDR ".number_format($product['price'])."</td>";
                echo "<td class='text-right'>".$product['qty']."</td>";
                echo "<td class='text-right'>".number_format($product['subtotal'])."</td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="3" class="text-right">Total :</td>
                <td colspan="1" class="text-right">IDR <?php echo number_format($order['total']);?></td>
            </tr>
            <tr id="courier_options">
                <td colspan="2"></td>
                <td class="text-right">Biaya Kirim:</td>
                <td colspan="1" class="text-right">IDR <?php echo number_format($order['ongkir']);?></td>
            </tr>
            <tr id="voucher_options">
                <td colspan="2"></td>
                <td class="text-danger text-right">Potongan Voucher</td>
                <td class="text-danger text-right">(IDR <?php echo number_format($order['potongan_voucher']);?>)</td>

            </tr>
            <tr id="grand_total">
                <td colspan="3" class="text-right"><h3>Grand Total :</h3></td>
                <td class="text-right" style="vertical-align: middle">IDR <?php echo number_format($order['grand_total']);?></td>
            </tr>


        </table>

        <?php echo anchor('payment/make/'.$order['id'],'Make Payment Now','class="btn btn-block btn-primary"');?>
    </div>
</div>