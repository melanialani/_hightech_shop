<?php
/**
* Created by: Nancy Yonata 
* Created at: 23 December 2015
 
  
* Controls everything back-end (nothing to do with user)
* Creates website for website's admin
 
*/
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url('index.php/admin/dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Change Status Order</h1>
			<?php echo form_open('barang/changeStatusOrder');?>
				<?php echo form_hidden('hidden_horderId', $horderId); ?>
				<div class="radio">
				  <?php 
					if($statusOrder == 1){
						echo "<label><input type='radio' name='optOrder' checked='true' value = '1'>Order Pending</label>";
					}
					else{
						echo "<label><input type='radio' name='optOrder' value = '0' >Order Pending</label>";
					}
				  ?>
				  
				</div>
				<br>
				
				<div class="radio">
				  <?php 
					if($statusOrder == 2){
						echo "<label><input type='radio' name='optOrder' checked='true' value = '2'>Order Sedang Diproses</label>";
					}
					else{
						echo "<label><input type='radio' name='optOrder' value = '0'>Order Sedang Diproses</label>";
					}
				  ?>	
				</div>
				<br>
				
				<div class="radio">
				   <?php 
					if($statusOrder == 3){
						echo "<label><input type='radio' name='optOrder' checked='true' value = '3'>Order Terkirim</label>";
					}
					else{
						echo "<label><input type='radio' name='optOrder' value = '0'>Order Terkirim</label>";
					}
				  ?>
				</div>
				<br>
				
				<div class="radio">
				   <?php 
					if($statusOrder == 4){
						echo "<label><input type='radio' name='optOrder' checked='true' value = '4'>Order Dibatalkan</label>";
					}
					else{
						echo "<label><input type='radio' name='optOrder' value = '0'>Order Dibatalkan</label>";
					}
				  ?>
				</div>
				<br>
				
				<div class="radio">
				 <?php 
					if($statusOrder == 5){
						echo "<label><input type='radio' name='optOrder' checked='true' value = '5'>Menunggu Verifikasi Merchant</label>";
					}
					else{
						echo "<label><input type='radio' name='optOrder' value = '0'>Menunggu Verifikasi Merchant</label>";
					}
				  ?>
				</div>
				<br>
				
				<div class = 'row'>
					<div class = 'col-md-12 col-sm-12 col-xs-12'>
						<?php echo form_submit(['id'=>'btnSave', 'name'=>'btnSave', 'class'=>'btn btn-primary btn-sm'], 'Save Change');?>
					</div>
				</div>
			
			<?php echo form_close(); ?>
		</div>
	</div><!--/.row-->
	
	<!-- INSERT CHARTS AND WHATEVER YOU WANT OVER HERE -->
	
	<div class="row">
		<div class="col-lg-12">
			<h5 class="page-header"><?php // content ?></h5>
		</div>
	</div>
</div>	<!--/.main-->