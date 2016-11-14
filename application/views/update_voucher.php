
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('index.php/admin/dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo $title; ?></li>
			</ol>
		</div><!--/.row-->
		
		<br />
		
		<div class="row">
			<div class="col-lg-12" align="center" >
				<div class="panel panel-primary" style="width: 75%">
					<div class="panel-heading">Edit Voucher</div>
				  	<div class="panel-body">
				  		<?php echo form_open('admin/updateVoucher'); ?>
				  			<?php echo form_hidden('id', $id); ?>
					  		<table class="table table-striped" width="100%">
					  			<tr>
					  				<th><b>Nama: </b></th>
					  				<th><input type='text' id='nama' name='nama' class='form-control' value='<?php echo $nama; ?>' /></th>
					  			</tr>
					  			<tr>
					  				<th><b>Potongan harga: </b></th>
					  				<th><input type='number' id='potongan_harga' name='potongan_harga' class='form-control' value='<?php echo $potongan_harga; ?>' /></th>
					  			</tr>
					  			<tr>
					  				<th><b>Tanggal awal: </b></th>
					  				<th><input type='date' id='awal' name='awal' class='form-control' value='<?php echo $awal; ?>' /></th>
					  			</tr>
					  			<tr>
					  				<th><b>Tanggal akhir: </b></th>
					  				<th><input type='date' id='akhir' name='akhir' class='form-control' value='<?php echo $akhir; ?>' /></th>
					  			</tr>
					  			<tr>
					  				<th><b>Status: </b></th>
					  				<th><input type='number' id='status' name='status' min='0' max='1' class='form-control' value='<?php echo $status; ?>' /></th>
					  			</tr>
					  			<tr>
					  				<th></th>
					  				<th><?php echo form_submit('save','Save','class="btn btn-primary" style="margin-left:88%;"'); ?></th>
					  			</tr>
					  		</table>
				        <?php echo form_close(); ?>
				  	</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<!-- INSERT CHARTS AND WHATEVER YOU WANT OVER HERE -->
		
		<div class="row">
			<div class="col-lg-12">
				<h5 class="page-header"><?php // content ?></h5>
			</div>
		</div>
	</div>	<!--/.main-->
