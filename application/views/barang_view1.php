<?php
/**
* Created by: Nancy Yonata 
* Created at: 8 December 2015
 
  Edited  at : 15 December 2015
  Edited  at : 17 December 2015
  
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
				<div class="container">
					<div class="row">
			
						<div class='row'>
							<div class="col-md-12 col-xs-12 col-sm-12">
							<div class="nav navbar navbar-inverse"  style="border-radius:0px;">
									<div class="container-fluid">
										<div class="navbar-collapse collapse" id="navbar">
											<ul class="nav navbar-nav">
												<li><?= anchor('barang/index','List Barang');?></li>
												<li><?= anchor('barang/page_insert_barang','Insert Barang');?></li>
											</ul>
										</div>
									</div>
							</div>
							</div>
						</div>
						
						<div class='row'>
							<div class = "col-md-12 col-xs-12 col-sm-12">
								<div class="page-header"><h1>Insert Detail Barang</h1></div>
							</div>
						</div>
						
						
							<?php echo form_open('barang/insertDetailBarang'); ?>
											<div class='form-group'>
												<div class = 'row'>
												<div class = 'col-md-4 col-xs-4 col-sm-4'>
													<div class = 'row'>
													<div class = 'col-md-12 col-xs-12 col-sm-12'>
														<div class = 'col-md-3 col-sm-3 col-xs-3'>
															<label for='inputNama' class='control-label'>Nama</label>
														</div>
													
														<div class = 'col-md-9 col-sm-9 col-xs-9'>
															<?php echo form_input(['id'=>'tbNama', 'name'=>'tbNama', 'class'=> 'form-control', 'placeholder'=> 'nama barang']); ?>
														</div>
														
													</div>
													</div>		
												</div>
												</div>
											</div>
											
											<div class='form-group'>
												<div class = 'row'>
												<div class = 'col-md-4 col-xs-4 col-sm-4'>
													<div class = 'row'>
													<div class = 'col-md-12 col-xs-12 col-sm-12'>
														<div class = 'col-md-3 col-sm-3 col-xs-3'>
															<label for='inputBrand' class='control-label'>Brand</label>
														</div>
														
														<div class = 'col-md-9 col-sm-9 col-xs-9'>
															<?php echo form_input(['id'=>'tbBrand', 'name'=>'tbBrand', 'class'=>'form-control', 'placeholder'=> 'brand barang' ]);?>
														</div>
													</div>
													</div>
												</div>
												</div>	
											</div>
											<div class='form-group'>
												<div class = 'row'>
												<div class = 'col-md-4 col-xs-4 col-sm-4' >
													<div class = 'row'>
													<div class = 'col-md-12 col-xs-12 col-sm-12'>
														<div class = 'col-md-3 col-sm-3 col-xs-3'>
															<label for='inputDeskripsi' class='control-label'>Deskripsi</label>
														</div>
														
														<div class = 'col-md-9 col-sm-9 col-xs-9'>	
															<?php echo form_textarea(['id'=>'tbDeskripsi', 'name'=>'tbDeskripsi', 'class'=>'form-control', 'rows'=>5, 'placeholder'=>'penjelasan barang'] );?>
														</div>
													</div>
													</div>
												</div>
												</div>
											</div>
											
											<div class='form-group'>
												<div class = 'row'>
												<div class = 'col-md-4 col-xs-4 col-sm-4'>
													<div class = 'row'>
													<div class = 'col-md-12 col-xs-12 col-sm-12'>
														<div class = 'col-md-3 col-sm-3 col-xs-3'>
															<label for='inputStock' class='control-label'>Stock</label>
														</div>
														
														<div class = 'col-md-9 col-sm-9 col-xs-9'>
															<?php echo form_input(['id'=>'tbStock', 'name'=>'tbStock', 'class'=>'form-control', 'placeholder'=>'stock barang']); ?>
														</div>
													
													</div>
													</div>
												</div>
												</div>
											</div>
											
											<div class='form-group'>
												<div class = 'row'>
												<div class = 'col-md-4 col-xs-4 col-sm-4'>
													<div class = 'row'>
													<div class = 'col-md-12 col-xs-12 col-sm-12'>
														<div class = 'col-md-3 col-sm-3 col-xs-3'>
															<label for='inputHarga' class='control-label'>Harga</label>
														</div>
														
														<div class = 'col-md-9 col-sm-9 col-xs-9'>
															<?php echo form_input(['id'=>'tbHarga', 'name'=>'tbHarga', 'class'=>'form-control' , 'placeholder'=>'harga barang']); ?>
														</div>
													</div>
													</div>
												</div>
												</div>
											</div>
											<div class='form-group'>
												<div class = 'row'>
												<div class = 'col-md-4 col-xs-4 col-sm-4'>
													<div class = 'row'>
													<div class = 'col-md-12 col-xs-12 col-sm-12'>
														<div class = 'col-md-3 col-sm-3 col-xs-3'>
															<label for='inputDiskon' class='control-label'>Diskon</label>
														 </div>
														<div class = 'col-md-9 col-sm-9 col-xs-9'>
															<?php echo form_input(['id'=>'tbDiskon', 'name'=>'tbDiskon', 'class'=>'form-control', 'placeholder'=>'diskon barang'])."<br>"; ?>
														</div>
													</div>
													</div>
												</div>
												</div>
											</div>	
										<div class='form-group'>
											<div class = 'row'>
											<div class = 'col-md-4 col-xs-4 col-sm-4'>
												<div class = 'row'>
												<div class = 'col-md-12 col-xs-12 col-sm-12'>
													<div class = 'col-md-3 col-sm-3 col-xs-3'>
														<label for='inputKategori' class='control-label'>Kategori</label>
													</div>
													
													<div class = 'col-md-9 col-sm-9 col-xs-9'>
														<?php echo form_dropdown('cbKategori', $allKategori)."<br>"; ?>		
													</div>
												</div>
												</div>
											</div>
											</div>
										</div>
										
										<div class='form-group'>
											<div class = 'row'>
											<div class = 'col-md-4 col-xs-4 col-sm-4'>
												<div class = 'row'>
												<div class = 'col-md-12 col-xs-12 col-sm-12'>
														<div class = 'col-md-3 col-sm-3 col-xs-3'>
															<label for='inputDetail' class='control-label'>Detail</label>
														</div>
														
														<div class = 'col-md-9 col-sm-9 col-xs-9'>
															<?php echo form_textarea(['id'=>'tbDetail', 'name'=>'tbDetail', 'class'=>'form-control', 'rows'=>5, 'placeholder'=>'detail barang'] );?>
														</div>
												</div>
												</div>
											</div>
											</div>
										</div>
										<div class='form-group'>
											<div class = 'row'>
											<div class = 'col-md-4 col-xs-4 col-sm-4'>
												<div class = 'row'>
												<div class = 'col-md-12 col-xs-12 col-sm-12'>
													<div class = 'col-md-3 col-sm-3 col-xs-3'>
														<label for='inputGaransi' class='control-label'>Garansi</label>
													</div>
													
													<div class = 'col-md-9 col-sm-9 col-xs-9'>
														<?php echo form_input(['id'=>'tbGaransi', 'name'=>'tbGaransi', 'class'=>'form-control', 'placeholder'=>'garansi barang'])."<br>";?>
													</div>
												</div>
												</div>
											</div>
											</div>
										</div>
										<div class='form-group'>
											<div class = 'row'>
												<div class = 'col-md-12 col-xs-12 col-sm-12'>
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
				<h5 class="page-header"><?php //echo $coba; ?></h5>
			</div>
		</div>
		
</div>	<!--/.main-->
