<?php
/**
* Created by: Nancy Yonata 
* Created at: 21 December 2015
  
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
				  <div class="panel-heading">Edit Header Order Barang</div>
				  <div class="panel-body">
					<?php echo form_open('barang/saveEditHOrder'); ?>
						<?php foreach($dataOrder as $row){?>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='idOrder' class='control-label'>Horder Id</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbId' class='control-label'><?php echo $row->id; ?></label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='usernameUser' class='control-label'>Username</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbUsernameUser' class='control-label'><?php echo $row->user_username; ?></label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='alamat' class='control-label'>alamat</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbAlamat' class='control-label'><?php echo $row->alamat; ?></label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='kota' class='control-label'>Kota</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbKota' class='control-label'><?php echo $row->kota; ?></label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='penerima' class='control-label'>Penerima</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbPenerima' class='control-label'><?php echo $row->nama_penerima; ?></label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='total' class='control-label'>Total</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbTotal' class='control-label'><?php echo $row->total; ?></label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='voucherId' class='control-label'>Voucher Id</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbVoucherId' class='control-label'>
									<?php
										if($row->voucher_id != ""){	echo $row->voucher_id;}										
										else{echo "-"; }
									?>
									</label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='grandTot' class='control-label'>Grand Total</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbGrandTot' class='control-label'>
									<?php echo $row->grand_total; ?>
									</label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='HrgJne' class='control-label'>Harga JNE</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbHargaJNE' class='control-label'>
									<?php 
										echo $row->harga_jne; 
									?>
									</label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='caraJNE' class='control-label'>Cara JNE</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbCaraJNE' class='control-label'>
									<?php 
										if($row->cara_jne != ""){ echo $row->cara_jne; }
										else{ echo "-"; }		
									?>
									</label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='kodeJNE' class='control-label'>Kode JNE</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbKodeJNE' class='control-label'>
									<?php
										echo form_hidden('h_kodejne', $row->kode_jne);
										if($row->kode_jne != ""){ echo $row->kode_jne; }
										else{ echo "-"; }		
									?>
									</label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='tipePembayaran' class='control-label'>Tipe Pembayaran</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbTipePemb' class='control-label'>
									<?php
										echo form_hidden('h_tipePemb', $row->tipe_pembayaran);
										if($row->tipe_pembayaran != ""){ echo $row->tipe_pembayaran; }
										else{ echo "-"; }		
									?>
									</label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='kodePemb' class='control-label'>Kode Pembayaran</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbKodePemb' class='control-label'>
									<?php 
										echo form_hidden('h_kodePemb', $row->kode_pembayaran);
										if($row->kode_pembayaran != ""){ echo $row->kode_pembayaran; }
										else{ echo "-"; }		
									?>
									</label>
									
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='tanggalCreate' class='control-label'>Tanggal Create</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbTglCreate' class='control-label'>
									<?php 
										if($row->tanggal_create != ""){ echo $row->tanggal_create; }
										else{ echo "-"; }		
									?>
									</label>
									
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='tglUpdate' class='control-label'>Tanggal Update</label>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<label for='tbTglUpdate' class='control-label'>
									<?php 
										if($row->tanggal_update != ""){ echo $row->tanggal_update; }
										else{ echo "-"; }		
									?>
									</label>
								</div>
							</div>
							</div>
							<br>
							<div class = 'row'>
							<div class = 'col-md-12 col-sm-12 col-xs-12'>
								<div class = 'col-md-3'>
									<label for='status' class='control-label'>Status</label><br>
								</div>		
								<div class = 'col-md-9 col-sm-9 col-xs-9'>
									<div class="radio">
									  <?php 
										if($row->status == 1){
											echo "<label><input type='radio' id = 'optOrder' name='optOrder' checked='true' value = '1'>Order Pending</label>";
										}
										else{
											echo "<label><input type='radio' id = 'optOrder' name='optOrder'  value = '1'>Order Pending</label>";
										}
									  ?>
									  
									</div>
									<br>
									
									<div class="radio">
									  <?php 
										if($row->status == 2){
											echo "<label><input type='radio' id = 'optOrder' name='optOrder' checked='true' value = '2'>Order Sedang Diproses</label>";
										}
										else{
											echo "<label><input type='radio' id = 'optOrder' name='optOrder' value = '2'>Order Sedang Diproses</label>";
										}
									  ?>	
									</div>
									<br>
									
									<div class="radio">
									   <?php 
										if($row->status == 3){
											echo "<label><input type='radio' id = 'optOrder' name='optOrder' checked='true' value = '3'>Order Terkirim</label>";
										}
										else{
											echo "<label><input type='radio' id = 'optOrder' name='optOrder' value = '3'>Order Terkirim</label>";
										}
									  ?>
									</div>
									<br>
									
									<div class="radio">
									   <?php 
										if($row->status == 4){
											echo "<label><input type='radio' id = 'optOrder' name='optOrder' checked='true' value = '4'>Order Dibatalkan</label>";
										}
										else{
											echo "<label><input type='radio' id = 'optOrder' name='optOrder' value = '4'>Order Dibatalkan</label>";
										}
									  ?>
									</div>
									<br>
									
									<div class="radio">
									 <?php 
										if($row->status == 5){
											echo "<label><input type='radio' id = 'optOrder' name='optOrder' checked='true' value = '5'>Menunggu Verifikasi Merchant</label>";
										}
										else{
											echo "<label><input type='radio' id = 'optOrder' name='optOrder'  value = '5'>Menunggu Verifikasi Merchant</label>";
										}
									  ?>
									</div>
									
				
									<br>
								</div>
							</div>
							</div>
							<br><br>
						
						<?php 
							$this->session->set_userdata('hidden_idhOrder', $row->id);
						}?>
						<div class = 'row'>
						<div class = 'col-md-12 col-xs-12 col-sm-12'>
							<div class = 'pull-right'>
								<?php echo form_submit(['id'=>'btnSave', 'name'=>'btnSave', 'class'=>'btn btn-primary btn-sm'], 'Save Change');?>
							</div>		
						</div>	
						</div>
						
					<?php echo form_close(); ?>
					<br>
					
					<?php echo form_open('barang/edit_detailOrder'); ?>
					<div class = 'row'>
						<div class = 'col-md-12 col-xs-12 col-sm-12'>
							<div class= 'col-md-offset-11'>
								<?php echo form_submit(['id'=>'btnDetailOrder', 'name'=>'btnDetailOrder', 'class'=>'btn btn-primary btn-sm'], 'Detail Order');?>
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
