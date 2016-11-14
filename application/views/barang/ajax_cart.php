<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="glyphicon glyphicon-shopping-cart"></i> Cart <span class="badge"><?php echo $this->cart->total_items();?></span></a>
<ul class="dropdown-menu" id="shopping_cart">
    <?php if($this->cart->total_items() > 0){ ?>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Detail</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Option</th>
            </tr>
            <?php
            foreach ($this->cart->contents() as $product) {
                $product_options = $this->cart->product_options($product['rowid']);
                echo "<tr>";
                echo "<td><img src='".base_url($product_options['gambar'])."' class='img' width='100'></td>";
                echo "<td>".anchor('items/detail/'.$product['id'],$product['name']."(".$product_options['warna'].")")."<br>";
                echo "IDR ".number_format($product['price'])."</td>";
                echo "<td>".$product['qty']."</td>";
                echo "<td>".number_format($product['subtotal'])."</td>";
                echo "<td><button class='btn btn-xs btn-danger btnDeleteCart' data-id='".$product['rowid']."'>x</button></td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="3" class="text-right">Total :</td>
                <td colspan="2" class="text-right">IDR <?php echo number_format($this->cart->total());?></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"></td>
                <td colspan="2" class="text-right"><?php echo anchor('orders/checkout','Checkout','class="btn btn-primary btn-sm"');?></td>
            </tr>
        </table>
    <?php }
    else { ?>
        <p align="text-center">There's nothing in this cart! Add more items to checkout!</p>
    <?php } ?>
</ul>