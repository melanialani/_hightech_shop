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
        <li class="active"><?php echo $barang['kategori'];?></li>
    </ol>
    <div class="items" class="row hidden-xs"><!--recommended_items-->
        <div class="page-header">
            <h2 class="title text-center">Items</h2>
        </div>
		<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-12">
        <?php
		//search form
		echo form_open('items/browse',['class'=>'form-horizontal','role'=>'form','method'=>'get']);
		echo form_label('Search for: ','searchTxt',['class'=>'control-label']);
		$data = ['name'=>'srcTxt', 'id'=>'srcTxt', 'class'=>'form-control', 'value'=>$search['name']];
		echo form_input($data)."<br/>";
		echo form_label('Category: ','categorydd',['class'=>'control-label']);
		echo form_dropdown('categorydd', $search['category_list'],$search['selected_category'],'class="form-control"')."<br/>";
		echo form_label('Brand: ','branddd',['class'=>'control-label']);
		echo form_dropdown('branddd', $search['brand_list'],$search['selected_brand'],'class="form-control"')."<br/>";
		?>
		<div class="controls form-inline">
		<label>Price range:</label><br/>
			<input name="minprice" id="minamt" type="hidden" value=<?php echo $search['minpricenow']?>>
			<input name="maxprice" id="maxamt" type="hidden" value=<?php echo $search['maxpricenow']?>>
			<label for="mindisp">Rp.</label>
			<input id="mindisp" type="text" style="display:inline;" size=10 value=<?php echo $search['minpricenow']?>>
			<label for="maxdisp"> - Rp.</label>
			<input id="maxdisp" type="text" style="display:inline;" size=10 value=<?php echo $search['maxpricenow']?>>
		</div>
		<br/>
		<div id="slider-range"></div>
		<br/>
		<?php
		echo form_submit('srcBtn', 'Search',"class='btn btn-primary'");
		echo form_close();
		//--
		?>
		</div>
		<div class="col-sm-9 col-md-9 col-xs-12">
		<?php
		foreach ($barang_list as $product) {
            echo "<div class='col-sm-6 col-md-4 col-xs-12 box-item'>".
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
		</div>
        <div class="row">
            <div class="col-md-9 col-md-offset-3">
                <div class='pull-right'><?=$links;?></div>
                <div class='pull-left'> <?=$viewstring?></div>
            </div>
        </div>


    </div>
    <script>
	Number.prototype.format = function(n, x) {
		var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
		return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
	};
	
	  $(function() {
		$( "#slider-range" ).slider({
		  range: true,
		  min: 0,
		  max: <?php echo $search['maxprice']?>,
		  values: [ <?php echo $search['minpricenow']?> , <?php echo $search['maxpricenow']?> ],
		  slide: function( event, ui ) {
			$( "#minamt" ).val(ui.values[ 0 ]);
			$( "#maxamt" ).val(ui.values[ 1 ]);
			$( "#mindisp" ).val(ui.values[ 0 ].format(0,3));
			$( "#maxdisp" ).val(ui.values[ 1 ].format(0,3));
		  },
		  change: function( event, ui ) {
			$( "#minamt" ).val(ui.values[ 0 ]);
			$( "#maxamt" ).val(ui.values[ 1 ]);
			$( "#mindisp" ).val(ui.values[ 0 ].format(0,3));
			$( "#maxdisp" ).val(ui.values[ 1 ].format(0,3));
		  }
		});
		$( "#mindisp" ).val($( "#slider-range" ).slider( "values", 0 ).format(0,3));
		$( "#maxdisp" ).val($( "#slider-range" ).slider( "values", 1 ).format(0,3));
	  });
		function unformat(value){
			var arr = value.split(",");
			return arr.join("");
		}
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
			$("#mindisp").bind("input",function (e){
				$("#slider-range").slider("values",0,unformat($("#mindisp").val()));
			});
			$("#maxdisp").bind("input",function (e){
				$("#slider-range").slider("values",1,unformat($("#maxdisp").val()));
			});
        });
    </script>