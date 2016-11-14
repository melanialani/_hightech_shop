<?php
/**
* Created by: Nancy Yonata 
  created at : 22 December 2015
  
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
		<br>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
				  <div class="panel-heading">Edit Detail Order</div>
				  <div class="panel-body">
					
					<?php echo form_open('barang/update_dOrder'); ?>
					<?php foreach ($detail_dorder as $row){ ?>
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='lb_horderId' class='control-label'>Header Order Id</label>
								</div>
								
								<div class = 'col-md-10'>
									<label for='horderId' class='control-label'><?php echo $row->horder_id; ?></label>
								</div>
							</div>
							</div>
							<br>
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='lb_brgId' class='control-label'>Barang Id</label>
								</div>
								
								<div class = 'col-md-10'>
									<label for='brgId' class='control-label'><?php echo $row->barang_id; ?></label>
								</div>
							</div>
							</div>
							<br>
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='lb_brgId' class='control-label'>Nama Barang</label>
								</div>
								
								<div class = 'col-md-10'>
									<label for='brgId' class='control-label'>
									<?php 
										$this->load->model('barang_model');
										$namaBrg = $this->barang_model->getNamaBrg($row->barang_id);
										echo $namaBrg; 
									?>
									</label>
								</div>
							</div>
							</div>
							<br>
							
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detKet' class='control-label'>Keterangan</label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$ket = $row->keterangan;
										echo form_textarea(['id'=>'tbKet', 'name'=>'tbKet', 'class'=> 'form-control', 'rows'=>2], $ket); 
									?>
								</div>
							</div>
							</div>
							<br>
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detQty' class='control-label'>Qty</label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$qty = $row->qty;
										echo form_input(['id'=>'tbQty', 'name'=>'tbQty', 'class'=> 'form-control'], $qty); 
									?>
								</div>
							</div>
							</div>
							<br>
							
							<div class= 'row'>
							<div class = 'col-md-12 col-xs-12 col-sm-12'>
								<div class = 'col-md-2'>
									<label for='detHarga' class='control-label'>Harga</label>
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
									<label for='detSubTotal' class='control-label'>Subtotal</label>
								</div>
								<div class = 'col-md-10'>
									<?php 
										$subtot = $row->subtotal;
										echo form_input(['id'=>'tbSubTotal', 'name'=>'tbSubTotal', 'class'=> 'form-control'], $subtot); 
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
							
					<?php 
						echo form_hidden('hidden_id', $row->id); 
						echo form_hidden('hidden_horderId', $row->horder_id); 
						echo form_hidden('hidden_barangId', $row->barang_id); 
					
					} ?>
					
					
					<div class = 'row'>
						<div class = 'col-md-12 col-xs-12 col-sm-12'>
							<div class = 'pull-right'>
								<?php echo form_submit(['id'=>'btnSave', 'name'=>'btnSave', 'class'=>'btn btn-primary btn-sm'], 'Save Change');?>
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






