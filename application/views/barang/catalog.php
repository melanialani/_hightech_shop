<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<script src="<?php echo base_url('assets/js/cross-zoom.js');?>"></script>
    <ol class="breadcrumb">
        <li><?php echo anchor('items','Home')?></li>
        <!-- IF ALAMATE-->
        <li><?php echo "Browse";?></a></li>
        <li class="active"><?php echo $barang['kategori'];?></li>
    </ol>
    <div class="items" class="row hidden-xs"><!--recommended_items-->
        <div class="page-header">
            <h2 class="title text-center">Items</h2>
        </div>
        <?php
		echo "<div class='row'>";
		foreach ($barang_list as $product) {
            echo "<div class='col-sm-4 col-md-3 col-xs-12 box-item'>".
                "<div class='thumbnail'>".
                "<img src='".base_url($product['gambar'][0])."' alt='".$product['gambar'][0]."' class='img-thumbnail'>".
                "<div class='caption text-center'>";
            ?>
            <h4><?php echo SUBSTR($product['nama'],0,29);?></h4>
            <small class='brand'><?php echo $product['kategori'];?></small>
            <p class='text-center'>
                <?php
                if ($product['diskon'] > 0){
                    //ada diskon
                    echo "<span>IDR <s>".number_format($product['harga'])."</s> <strong class='text-danger'>".number_format($product['harga_total'])."</strong></span><br/>";
                }
                else {
                    echo "IDR ".$product['harga_total'];
                }
                ?>
            </p>
            <p class='text-center'><a href="<?php echo base_url('items/detail/'.$product['id']) ;?>" class="btn btn-primary btn-sm" role="button">View Item</a></p>
            <?php echo"</div>".
                "</div>".
                "</div>";
        }
		echo "</div>";
		echo "<div class='row'>";
		echo "<div class='col-sm-11 col-md-11 col-xs-11'>";
		echo $links;
		echo "<p class='text-right'>Viewing items $start to $end from $count</p>";
		echo "</div>";
		echo "</div>";
        ?>
    </div>
    <script>
        $(document).ready(function(e) {
            $("button[name='btnaddtocart']").click(function (e){
                var jum = $('#injumtocart').val();
                var warna = $('#warna').val();
                var id = $(this).attr('data-id');
                $.post('<?php echo site_url('items/addToCart');?>', {cart_qty: jum, cart_id:id, cart_warna:warna}, function (data){
                    $('#shopping_link').html(data);
                    $('#shopping_link a').attr('aria-expanded','true');
                    $('#shopping_link').addClass('open');
                });
            });
        });
    </script>