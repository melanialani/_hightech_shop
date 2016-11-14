
<div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <div class="stepwizard">
                <div class="stepwizard-row">
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-primary btn-circle">1</button>
                        <p>Your Cart</p>
                    </div>
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-default btn-circle">2</button>
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
            <div class="page-header">
                <h2>Your cart <small>Check your purchases</small></h2>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-right">Price</th>
                    <th>Quantity</th>
                    <th class="text-right">Total</th>
                    <th width="40"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->cart->contents() as $product){
                    $product_options = $this->cart->product_options($product['rowid']);
                ?>
                <tr><?php echo form_open();?>
                    <?php echo form_hidden('cart_rowid', $product['rowid']);?>
                    <td>
                        <div class="media">
                            <a class="thumbnail pull-left" href="<?php echo site_url('items/detail/'.$product['id']);?>"> <img class="media-object" src="<?php echo base_url($product_options['gambar']);?>" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body" >
                                <h4 class="media-heading"><?php echo anchor('items/detail/'.$product['id'],$product['name']." (".$product_options['warna'].")");?></h4>
                                <h5 class="media-heading"><?php echo $product_options['kategori'];?></h5>
                            </div>
                        </div></td>
                    <td style="text-align: right">
                        <strong><?php echo number_format($product['price']);?></strong>
                    <td style="text-align: right">
                        <?php echo form_input(['name'=> 'cart_qty', 'type' => 'number', 'class' => 'form-control', 'value'=> $product['qty']]);?>
                        <?php echo form_submit('btnEditCart', 'Update', 'class="btn btn-default btn-sm"');?>
                    </td>
                    <td class="text-right"><strong>IDR <?php echo number_format($product['subtotal']);?></strong></td>
                    <td class="text-right">
                        <?php echo form_submit('btnRemoveCart', 'Remove', 'class="btn btn-danger btn-sm"');?>
                    <?php echo form_close();?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>Total</h5></td>
                    <td class="text-right"><h5><strong><?php echo number_format($this->cart->total());?></strong></h5></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>

                        <a href="<?php echo site_url('/');?>" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </a></td>
                    <td>
                        <a href="<?php echo site_url('orders/billing');?>" class="btn btn-success">
                            Manage Billing <span class="glyphicon glyphicon-play"></span>
                        </a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
