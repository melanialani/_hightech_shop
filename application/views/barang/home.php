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
        <li>Home</li>
    </ol>
	<div class="row">
		<div class="col-sm-12 col-md-12">
            <div class="view-product">
                <div id='carousel-custom' class='carousel slide' data-ride='carousel' style="width:100%">
					<div class='carousel-inner '>
						<div class='item active'>
							<p class="text-center"><img src='<?php echo base_url('images/promo1.png');?>' alt='LOL' id="zw"/></p>
						</div>
						<div class='item'>
							<p class="text-center"><img src='<?php echo base_url('images/promo2.png');?>' alt='LOLOL' id="zw2"/></p>
						</div>
					</div>
					<!-- sag sol -->
					<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
						<span class='glyphicon glyphicon-chevron-left'></span>
					</a>
					<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
						<span class='glyphicon glyphicon-chevron-right'></span>
					</a>
                </div>
            </div>
        </div>
	</div>
    <div id="popular_items" class="row"><!--recommended_items-->
        <div class="page-header">
            <h2 class="title text-center">Popular Items</h2>
        </div>
        <?php
       foreach ($popular_barang as $product) {
            echo "<div class='col-sm-4 col-md-3 col-xs-12 box-item'>".
                "<div class='thumbnail'>".
                "<img src='".base_url($product['gambar'])."' alt='".$product['gambar']."' class='img-thumbnail'>".
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
                    echo "IDR ".number_format($product['harga_total']);
                }
                ?>
            </p>
            <p class='text-center'><a href="<?php echo base_url('items/detail/'.$product['id']) ;?>" class="btn btn-primary btn-sm" role="button">View Item</a></p>
            <?php echo"</div>".
                "</div>".
                "</div>";
        }
        ?>
		</div>
		<div id="recent_items" class="row"><!--recommended_items-->
        <div class="page-header">
            <h2 class="title text-center">Recently Bought Items</h2>
        </div>
        <?php
       foreach ($recent_barang as $product) {
            echo "<div class='col-sm-4 col-md-3 col-xs-12 box-item'>".
                "<div class='thumbnail'>".
                "<img src='".base_url($product['gambar'])."' alt='".$product['gambar']."' class='img-thumbnail'>".
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
                    echo "IDR ".number_format($product['harga_total']);
                }
                ?>
            </p>
            <p class='text-center'><a href="<?php echo base_url('items/detail/'.$product['id']) ;?>" class="btn btn-primary btn-sm" role="button">View Item</a></p>
            <?php echo"</div>".
                "</div>".
                "</div>";
        }
        ?>
		</div>
		<div id="random_items" class="row"><!--recommended_items-->
        <div class="page-header">
            <h2 class="title text-center">Random Items</h2>
        </div>
        <?php
       foreach ($random_barang as $product) {
            echo "<div class='col-sm-4 col-md-3 col-xs-12 box-item'>".
                "<div class='thumbnail'>".
                "<img src='".base_url($product['gambar'])."' alt='".$product['gambar']."' class='img-thumbnail'>".
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
                    echo "IDR ".number_format($product['harga_total']);
                }
                ?>
            </p>
            <p class='text-center'><a href="<?php echo base_url('items/detail/'.$product['id']) ;?>" class="btn btn-primary btn-sm" role="button">View Item</a></p>
            <?php echo"</div>".
                "</div>".
                "</div>";
        }
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