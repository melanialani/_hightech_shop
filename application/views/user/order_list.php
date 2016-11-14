<style>
    table tr{
        cursor:pointer;
    }
</style>
<div class="page-header">
    <H1>My Orders</H1>
</div>
<div class="row">
    <div class="col-md-12">
<?php
if(!$orders) { // Jika tidak ada
    echo "Sorry. You haven't made any orders yet.";
}
else { ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Order No#</th>
                <th>Barang</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal Update</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order){
                echo "<tr data-url='".site_url('orders/confirm/'.$order['id'])."'>";
                echo "<td>".$order['id']."</td>";
                echo "<td>".$order['barang']."</td>";
                echo "<td>IDR ".number_format($order['grand_total'])."</td>";

                $arr = ['<span class="label label-danger">Order Canceled</span>',
                        '<span class="label label-default">Waiting for Payment</span>',
                        '<span class="label label-info">Order Proccessed</span>',
                        '<span class="label label-success">Order Sent</span>',
                        '<span class="label label-info">Processing Payment</span>'
                    ];
                echo "<td>".$arr[$order['status']]."</td>";
                echo "<td>".$order['tanggal_update']."</td>";
                echo "</tr></a>";
            }?>
        </tbody>

    </table>


<?php }
?>
    </div>
</div>
<script>
    $(function () {
        $('table.table tr').click(function () {
            window.location.href = $(this).data('url');
        });
    })
</script>
