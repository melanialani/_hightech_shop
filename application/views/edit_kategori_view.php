<?php
/**
* Created by: Nancy Yonata 
* Created at: 20 December 2015
  
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
				<div class="panel panel-primary">
				  <div class="panel-heading">Edit Kategori Barang</div>
				  <div class="panel-body">
					<?php echo form_open('barang/update_kategori'); ?>
						<?php foreach($dataKategori as $row){?>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='detNama' class='control-label'>Nama Kategori</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<?php 
										$nama = $row->nama;
										echo form_input(['id'=>'tbNama', 'name'=>'tbNama', 'class'=> 'form-control'], $nama); 
									?>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='detail' class='control-label'>detail kategori</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<?php 
										$detail = $row->field_detail;
										echo form_textarea(['id'=>'tbDetail', 'name'=>'tbDetail', 'class'=> 'form-control', 'rows'=> 3], $detail); 
									?>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='status' class='control-label'>status kategori</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<?php 
										$status = $row->status;
										echo form_input(['id'=>'tbStatus', 'name'=>'tbStatus', 'class'=> 'form-control'], $status); 
									?>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
								<div class = 'col-md-12 col-xs-12 col-sm-12'>
									<div class = 'col-md-offset-11'>
										<?php echo form_submit(['id'=>'btnSave', 'name'=>'btnSave', 'class'=>'btn btn-primary btn-sm'], 'Save');?>
									</div>
								</div>
							</div>
							
							
						<?php echo form_hidden('hidden_id', $row->id); }?>
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
