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
        <li><?php echo anchor('items','Home');?></li>
        <li><?php echo $barang['kategori'];?></a></li>
    </ol>
    <div class="row"><!--comparison table-->
		<?php echo form_open('items/compare',['role'=>'form','method'=>'get'])?>
        <div class="col-sm-4 col-md-4 col-lg-4">
			<?php echo form_dropdown('comp1',$list_all_barang,$compare['item1'],"class='form-control'")?>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<?php echo form_dropdown('comp2',$list_other_barang,$compare['item2'],"class='form-control' $dis2")?>
		</div>			
		<div class="col-sm-4 col-md-4 col-lg-4">
			<?php echo form_dropdown('comp3',$list_other_barang,$compare['item3'],"class='form-control' $dis3")?>
		</div>
	</div>
	<div class="row">
		<p class ="text-center"><br/><?php echo form_submit('compbtn', 'Compare',"class='btn btn-primary'");?></p>
	</div>
	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<?php if(isset($barang['a']['gambar'][0])) echo "<img src='".base_url($barang['a']['gambar'][0])."' alt=''class='img-responsive'/>"?>
			<p class='text-center'>
                <?php
				if(isset($barang['a']['harga'])){
					echo "<b>Brand:</b>".$barang['a']['brand']."<br/>";
					if ($barang['a']['diskon'] > 0){
						echo "<span>IDR <s>".number_format($barang['a']['harga'])."</s> <strong class='text-danger'>".number_format($barang['a']['harga_total'])."</strong></span><br/>";
					}
					else {
						echo "IDR ".number_format($barang['a']['harga_total'])."<br/>";
					}
					if ( $barang['a']['stok'] > 0) {
						echo "<span class='label label-success'>In Stock</span><br/>";
					}else {
						echo "<span class='label label-danger'>Out of Stock</span><br/>";
					}
					echo "<p class='text-center'><a href='".base_url('items/detail/'.$barang['a']['id']). "' class='btn btn-primary btn-sm' role='button'>View Item</a></p>";
				}
                ?>
            </p>
			<table class="table table-bordered">
			<?php
			foreach ($barang['a']['spesifikasi'] as $key => $value){
				echo "<tr><th>".$key."</th>";
				echo "<td>".$value."</td></tr>";
			}
			?>
			</table>
        </div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<?php if(isset($barang['b']['gambar'][0])) echo "<img src='".base_url($barang['b']['gambar'][0])."' alt=''class='img-responsive'/>"?>
			<p class='text-center'>
                <?php
				if(isset($barang['b']['harga'])){
					echo "<b>Brand:</b>".$barang['b']['brand']."<br/>";
					if ($barang['b']['diskon'] > 0){
						echo "<span>IDR <s>".number_format($barang['b']['harga'])."</s> <strong class='text-danger'>".number_format($barang['b']['harga_total'])."</strong></span><br/>";
					}
					else {
						echo "IDR ".$barang['b']['harga_total']."<br/>";
					}
					if ( $barang['b']['stok'] > 0) {
						echo "<span class='label label-success'>In Stock</span><br/>";
					}else {
						echo "<span class='label label-danger'>Out of Stock</span><br/>";
					}
					echo "<p class='text-center'><a href='".base_url('items/detail/'.$barang['b']['id']). "' class='btn btn-primary btn-sm' role='button'>View Item</a></p>";
				}
                ?>
            </p>
			<table class="table table-bordered">
			<?php
			foreach ($barang['b']['spesifikasi'] as $key => $value){
				echo "<tr><th>".$key."</th>";
				echo "<td>".$value."</td></tr>";
			}
			?>
			</table>
        </div>
		
		<div class="col-sm-4 col-md-4 col-lg-4">
			<?php if(isset($barang['c']['gambar'][0])) echo "<img src='".base_url($barang['c']['gambar'][0])."' alt=''class='img-responsive'/>"?>
			<p class='text-center'>
                <?php
				if(isset($barang['c']['harga'])){
					echo "<b>Brand:</b>".$barang['c']['brand']."<br/>";
					if ($barang['c']['diskon'] > 0){
						echo "<span>IDR <s>".number_format($barang['c']['harga'])."</s> <strong class='text-danger'>".number_format($barang['c']['harga_total'])."</strong></span><br/>";
					}
					else {
						echo "IDR ".$barang['c']['harga_total']."<br/>";
					}
					if ( $barang['c']['stok'] > 0) {
						echo "<span class='label label-success'>In Stock</span><br/>";
					}else {
						echo "<span class='label label-danger'>Out of Stock</span><br/>";
					}
					echo "<p class='text-center'><a href='".base_url('items/detail/'.$barang['c']['id']). "' class='btn btn-primary btn-sm' role='button'>View Item</a></p>";
				}
                ?>
            </p>
			<table class="table table-bordered">
			<?php
			foreach ($barang['c']['spesifikasi'] as $key => $value){
				echo "<tr><th>".$key."</th>";
				echo "<td>".$value."</td></tr>";
			}
			?>
			</table>
        </div>
		
		<?php echo form_close()?>
    </div><!--/category-tab-->
    <script>
        $(function () {
            $('.shop-details-tab ul.nav-tabs a:first').tab('show')
        })
    </script>
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