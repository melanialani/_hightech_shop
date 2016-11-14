<?php
/**
* Created by: Nancy Yonata 
  created at : 15 December 2015
  
* Controls everything back-end (nothing to do with user)
* Creates website for website's admin
 
*/

?>
<?php echo "view detail ";?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('index.php/admin/dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo $title; ?></li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
				  <div class="panel-heading">Edit Detail Barang</div>
				  <div class="panel-body">
					
					<?php echo form_open('barang/editBarangStep1'); ?>
					<?php foreach ($detail as $row){ ?>
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detNama' class='control-label'>Nama Barang </label>
								</div>
								
								<div class = 'col-md-10'>
									<?php 
										$nama = $row->nama;
										echo form_input(['id'=>'tbNama', 'name'=>'tbNama', 'class'=> 'form-control'], $nama); 
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detBrand' class='control-label'>Brand Barang </label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$brand = $row->brand;
										echo form_input(['id'=>'tbBrand', 'name'=>'tbBrand', 'class'=> 'form-control'], $brand); 
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detDesk' class='control-label'> Dekripsi </label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$des = $row->deskripsi;
										echo form_textarea(['id'=>'tbDeskripsi', 'name'=>'tbDeskripsi', 'class'=>'form-control', 'rows'=>2], $des);
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detBrand' class='control-label'>Stock Barang </label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$stock = $row->stok;
										echo form_input(['id'=>'tbStock', 'name'=>'tbStock', 'class'=> 'form-control'], $stock); 
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detHarga' class='control-label'>Harga Barang </label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$hrg = $row->harga;
										echo form_input(['id'=>'tbHarga', 'name'=>'tbHarga', 'class'=> 'form-control'], $hrg); 
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detBrand' class='control-label'>Diskon Barang </label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$diskon = $row->diskon;
										echo form_input(['id'=>'tbDiskon', 'name'=>'tbDiskon', 'class'=> 'form-control'], $diskon); 
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detBrand' class='control-label'>Detail Barang </label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$det = $row->field_detail;
										echo form_textarea(['id'=>'tbDetail', 'name'=>'tbDetail', 'class'=>'form-control', 'rows'=>2], $det);
									
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detBrand' class='control-label'>Garansi</label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$garansi = $row->garansi;
										echo form_input(['id'=>'tbGaransi', 'name'=>'tbGaransi', 'class'=> 'form-control'], $garansi); 
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detBerat' class='control-label'>Berat</label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$berat = $row->berat_gram;
										echo form_input(['id'=>'tbBerat', 'name'=>'tbBerat', 'class'=> 'form-control'], $berat); 
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detBrand' class='control-label'>Status</label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$status = $row->status;
										echo form_input(['id'=>'tbStatus', 'name'=>'tbStatus', 'class'=> 'form-control'], $status); 
									?>
								</div>
							</div>
							</div>
							<br>
							
					<?php echo form_hidden('hidden_id', $row->id); } ?>
					
					
					<div class = 'row'>
						<div class = 'col-md-12  col-sm-12 col-xs-12'>
							<div class= 'pull-right'>
								<?php echo form_submit(['id'=>'btnSave', 'name'=>'btnSave', 'class'=>'btn btn-primary btn-sm'], 'Save Change');?>
							</div>
						</div>
					</div>
					<br>
					<div class = 'row'>
						<div class = 'col-md-12 col-xs-12 col-xs-12 col-sm-12'>
							<div class= 'pull-right'>
								<?php echo form_submit(['id'=>'btnNext', 'name'=>'btnNext', 'class'=>'btn btn-primary btn-sm'], 'Next');?>
							</div>
						</div>
					</div>
					
					
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






