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
							<div class="col-lg-12">
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
							<div class="col-lg-12">
								<div class="page-header"><h1>Insert Image Barang dan Warna</h1></div>
							</div>
						</div>
						
						<div class='row'>
							<div class="col-lg-12">
								<?php echo form_open_multipart('barang/insertDetailGambar'); ?>
									
									<div class="form-group">
											<div class = 'row'>
											<div class = "col-md-6 col-xs-6 col-sm-6">
												<div class = 'row'>
												<div class = "col-md-12 col-xs-12 col-sm-12">
													<div class = "col-md-5 col-sm-5 col-xs-5">
														<input type="file" name="gambar1" size="20" />
													</div>
													<div class = "col-md-7 col-sm-7 col-xs-7">	
														<label for="inputWarna1" class="control-label">Warna</label>
														<?php echo form_input(['name'=>'inputWarnaGbr1', 'class'=>'form-control', 'placeholder'=>'warna barang'])."<br>"; ?>
													</div>
												</div>
												</div>
											</div>
											</div>
									</div>
									
									
									<div class="form-group">
											<div class = 'row'>
											<div class = "col-md-6 col-xs-6 col-sm-6">
												<div class = 'row'>
												<div class = "col-md-12 col-xs-12 col-sm-12">
													<div class = "col-md-5 col-sm-5 col-xs-5">
														<input type="file" name="gambar2" size="20" />
													</div>
													<div class = "col-md-7 col-sm-7 col-xs-7">	
														<label for="inputWarna2" class="control-label">Warna</label>
														<?php echo form_input(['name'=>'inputWarnaGbr2', 'class'=>'form-control', 'placeholder'=>'warna barang'])."<br>"; ?>
													</div>
												</div>
												</div>
											</div>
											</div>
									</div>			

									<div class="form-group">
											<div class = 'row'>
											<div class = "col-md-6 col-xs-6 col-sm-6">
												<div class = 'row'>
												<div class = "col-md-12 col-xs-12 col-sm-12">
													<div class = "col-md-5 col-sm-5 col-xs-5">
														<input type="file" name="gambar3" size="20" />
													</div>
													
													<div class = "col-md-7 col-sm-7 col-xs-7">	
														<label for="inputWarna2" class="control-label">Warna</label>
														<?php echo form_input(['name'=>'inputWarnaGbr3', 'class'=>'form-control', 'placeholder'=>'warna barang'])."<br>"; ?>
													</div>
												</div>
												</div>
											</div>
											</div>
									</div>			
	
									<div class = 'row'>		
										<div class = 'col-md-12 col-xs-12 col-sm-12'>
											<?php echo form_submit(['name'=>'btnSubmit', 'class'=>'btn btn-primary btn-sm'], 'Submit'); ?>
										</div>
									</div>
								
								<?php echo form_close(); ?>
							</div>
						</div>
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
