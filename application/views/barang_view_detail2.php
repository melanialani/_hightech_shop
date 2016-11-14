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
				  <div class="panel-heading">Edit Gambar Barang</div>
				  <div class="panel-body">
					
					<div class = 'row'>
						<div class = 'col-md-12 col-xs-12 col-sm-12'>
							<h3>Update Gambar Barang</h3>
						</div>
					</div>
					
					<?php echo form_open_multipart('barang/editBarangStep2'); ?>
						<?php foreach ($detail as $row){ ?>
								<?php
									
									$fileGambar = $row->gambar;
									$arrGambar = explode(';', $fileGambar);
									
									$warnaBarang = $row->warna;
									$arrWarna = explode(';', $warnaBarang);
									
									
									echo form_hidden('hiddenCountGbr', count($arrGambar));
									for($i = 0; $i<count($arrGambar); $i++){
										
										echo "<div class= 'row'>";
										echo "<div class = 'col-md-12 col-xs-12 col-sm-12'>";
											echo "<div class = 'col-md-6 col-xs-6 col-sm-6'>";
												echo "<div class = 'row'>";
												echo "<div class= 'col-md-12 col-xs-12 col-sm-12'>";
													echo "<img src='" . base_url() .$arrGambar[$i]. "' width= '100px' height= '100px'>";
													echo "<br><br><br>";
														$name = "gambar".$i."";  
														echo "<input type='file' name='".$name."' size='20'/>";
													echo "<br>";
												echo "</div>";
												echo "</div>";
											echo "</div>";	
										echo "</div>";	
										echo "</div>";
										
										//form warna barang
										echo "<div class= 'row'>";
										echo "<div class = 'col-md-12 col-xs-12 col-sm-12'>";
											
											echo "<div class = 'col-md-6 col-xs-6 col-sm-6'>";
												echo "<div class = 'row'>";
												echo "<div class= 'col-md-12 col-xs-12 col-sm-12'>";
													
													echo "<div class= 'col-md-3 col-xs-3 col-sm-3'>";
														echo "<label for='inputWarna' class='control-label'>Warna</label>";
													echo "</div>";
													
													echo "<div class = 'col-md-9 col-xs-9 col-sm-9'>";
														 $name_warna = "tbWarna".$i."";
														 echo form_input(['id'=>$name_warna, 'name'=>$name_warna, 'class'=> 'form-control'], $arrWarna[$i]);
													echo "</div>";
													
												echo "</div>";
												echo "</div>";
											echo "</div>";
										
										echo "</div>";
										echo "</div>";
										
										echo "<div class= 'row'>";
										echo "<div class = 'col-md-12 col-xs-12 col-sm-12'>";
											echo form_submit(['id'=>'btnDeleteGbr'.$i, 'name'=>'btnDeleteGbr'.$i, 'class'=>'btn btn-primary btn-sm'], 'Delete Gambar');
										echo "</div>";
										echo "</div>";
										
										echo "<br><br>";
									}
								
									echo "<br><br>";
														
								?>	
								
						<?php 
							echo form_hidden('hidden_id', $row->id); 
							$this->session->set_userdata('id_barang', $row->id);
						
						} ?>
						<div class = 'row'>
							<div class = 'col-md-12 col-md-offset-11 col-xs-12 col-xs-offset-11 col-sm-12 col-sm-offset-11'>
								<?php echo form_submit(['id'=>'btnSave', 'name'=>'btnSave', 'class'=>'btn btn-primary btn-sm'], 'Save');?>
							</div>
						</div>
					<?php echo form_close(); ?>
				  
					<!-- Small modal -->
					<div class = 'row'>
						<div class = 'col-md-12 col-sm-12 col-xs-12'>
							<div class = 'col-md-3 col-xs-3 col-sm-3'>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Tambah Gambar</button>
							</div>
						</div>
					</div>
					
					<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
					  <div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class = 'row'>
								<div class = 'col-md-12 col-sm-12 col-xs-12'>
									<?php echo form_open_multipart('barang/tambahGambar'); ?>
										<div class = 'row'> 
											<div class = 'col-md-12 col-sm-12 col-xs-12'>
												<div class= 'col-md-10 col-xs-10 col-sm-10'>
													<h3>Insert Gambar Baru</h3>
												</div>
											</div>
										</div>
										<br><br>
										<div class = 'row'>
											<div class = 'col-md-12 col-sm-12 col-xs-12'>
												
												<div class= 'row'>
												<div class = 'col-md-12 col-xs-12 col-sm-12'>
													<div class = 'col-md-10 col-xs-10 col-sm-10'>	
														<input type= "file" name= "fotoBarang" >
													</div>
												</div>
												</div>
												
												
												<br><br>
												<div class = 'row'>
												<div class = 'col-md-12 col-sm-12 col-xs-12'>	
													<div class = 'col-md-3 col-sm-3 col-xs-3'>
														<label for='inputWarna' class='control-label'>Warna</label>
													</div>
													
													<div class = 'col-md-9 col-sm-9 col-xs-9'>
														<?php echo form_input(['name'=>'warnaBarang', 'placeholder'=> 'warna barang', 'class'=> 'form-control']); ?>
													</div>
													
												</div>
												</div>
											
											
											</div>
										</div>
										<br><br>	
										<div class = 'row'>
											<div class = 'col-md-12 col-sm-12 col-xs-12'>
												<div class= 'col-md-8'>
													<div class = 'row'>
													<div class = 'col-md-12 col-md-offset-7'>	
														<div class = 'col-md-5 col-sm-5 col-xs-5'>
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
														<div class = 'col-md-7 col-sm-7 col-xs-7'>
															<?php echo form_submit(['name'=>'btnInsert', 'class'=> 'btn btn-primary'], 'Insert'); ?>
														</div>
													</div>
													</div>
												</div>	
											</div>
										</div>
										<br><br>		
									<?php echo form_close(); ?>		
								</div>
							</div>
							
						</div>
					  </div>
					</div>
				  
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
		<img id="foto_image">
</div>	<!--/.main-->

