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
        <li class="active"><?php echo $barang['nama'];?></li>
    </ol>
    <div class="product-details row"><!--product-details-->
        <div class="col-sm-4 col-md-4">
            <div class="view-product">
                <div id='carousel-custom' class='carousel slide' data-ride='carousel' style="width:100%">
                    <div class='carousel-outer'>
                        <div class='carousel-inner '>
                            <div class='item active'>
                                <img src='<?php echo base_url($barang['gambar'][0]);?>' alt='' id="zw"  data-zoom-image="<?php echo base_url($barang['gambar'][0]);?>"/>
                            </div>
                            <?php if(count($barang['gambar']) > 1) {
                                for ($i = 1; $i < count($barang['gambar']); $i++) {
                                    ?>
                                    <div class='item'>
                                        <img src='<?php echo base_url($barang['gambar'][$i]);?>' alt=''class="zoom_image"  data-zoom-image="<?php echo base_url($barang['gambar'][$i]);?>"/>
                                    </div>
                                <?php
                                }
                            }?>
                            <script>    $("#zw").elevateZoom({ zoomType    : "inner", cursor: "crosshair" });</script>
                        </div>

                        <!-- sag sol -->
                        <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                            <span class='glyphicon glyphicon-chevron-left'></span>
                        </a>
                        <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                            <span class='glyphicon glyphicon-chevron-right'></span>
                        </a>
                    </div>

                    <!-- thumb -->
                    <ol class='carousel-indicators meartlab'>
                        <li data-target='#carousel-custom' data-slide-to='0' class='active'><img src='<?php echo base_url($barang['gambar'][0]);?>' alt='' /></li>
                        <?php if(count($barang['gambar']) > 1) {
                            for ($i = 1; $i < count($barang['gambar']); $i++) {
                                ?>
                                <li data-target='#carousel-custom' data-slide-to='<?php echo $i;?>'><img src='<?php echo base_url($barang['gambar'][$i]);?>' alt='' /></li>
                            <?php
                            }
                        }?>
                    </ol>
                </div>

<!--                <img src="--><?php //echo base_url($barang['gambar'][0]);?><!--" alt="" style="width:100%;" />-->
            </div>
        </div>
        <div class="col-sm-8 col-md-8">
            <div class="product-information"><!--/product-information-->
                <!--<img src="_images/coba.jpg" class="newarrival" alt="" />-->
                <h2><?php echo $barang['nama'];?></h2>
                <p>#ID: <?php echo $barang['id'];?></p>
								<span>
									<?php
                                    if ($barang['diskon'] > 0 ){
                                        echo "<span>IDR <s>".number_format($barang['harga'])."</s> <strong class='text-danger'>".number_format($barang['harga_total'])."</strong></span><br/>";
                                    }
                                    else {
                                        echo "<span>IDR ".number_format($barang['harga_total'])."</span><br/>";
                                    }
                                    ?>
                                        <p><b>Brand:</b><?php echo $barang['brand'];?></p>
                                        <p><b>Availability:</b>
                                            <?php if ( $barang['stok'] > 0) {
                                                echo "<span class='label label-success'>In Stock</span><br/><br/>"; ?>
                                                <label for="injumtocart">Quantity:</label>
                                                <input type="number" max="<?php echo $barang['stok']; ?>" value="1" name="injumtocart" id="injumtocart"  min="1"/><br/>
                                                <strong>Color </strong>: <select id="warna">
                                                    <?php
                                                        foreach ($barang['warna'] as $warna){
                                                            echo "<option value='$warna'>$warna</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <button type="submit" class="btn btn-default cart btn-sm" name='btnaddtocart' data-id="<?php echo $barang['id'];?>">
                                                    <i class="glyphicon glyphicon-shopping-cart"></i> Add to cart
                                                </button>
                                            <?php }
                                            else {
                                                echo "<span class='label label-danger'>Out of Stock</span><br/>";
                                            }?>
                                        </p>


                                    </form>
								</span>
                <!-- share facebook and twitter-->
                <div class="fb-share-button" data-href="<?php echo site_url('item/detail/'.$barang['id']);?>" data-layout="button_count"></div>
                <a href="http://twitter.com/home?status=Buy now! <?php echo site_url('item/detail/'.$barang['id']);?>" title="Click to share this post on Twitter"><i class='fa fa-twitter'></i>Share to Twitter</a><br/><br/>
				<div class="btn btn-sm btn-info"><?php $id = $barang['id']; echo anchor("items/compare?comp1=$id","Compare","style = 'text-decoration: none; color: #FFFFFF'"); ?></div>
            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->

    <div class="category-tab shop-details-tab row"><!--category-tab-->
        <div class="col-sm-12">
            <br/>
            <ul class="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Details</a></li>
                <li><a href="#spesifikasi" data-toggle="tab">Spesifikasi</a></li>
            </ul>

        <br/>
        <div class="tab-content">
            <div class="tab-pane fade" id="details" >
                <?php echo $barang['deskripsi'];?>
            </div>


            <div class="tab-pane fade" id="spesifikasi" >
                <table class="table table-bordered">

                <?php
                foreach ($barang['spesifikasi'] as $key => $value){
                    echo "<tr><th>".$key."</th>";
                    echo "<td>".$value."</td></tr>";
                }
                ?>
                </table>
            </div>
        </div>
        </div>
    </div><!--/category-tab-->
    <script>
        $(function () {
            $('.shop-details-tab ul.nav-tabs a:first').tab('show')
        })
    </script>
    <div class="recommended_items" class="row hidden-xs"><!--recommended_items-->
        <div class="page-header">
            <h2 class="title text-center">Recommended Items</h2>
        </div>
        <?php

       foreach ($other_barang as $product) {
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