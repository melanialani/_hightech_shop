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
			<div class="col-md-12 col-xs-12 col-sm-12">
				<div class="container">
					<div class="row">
			
						<div class='row'>
							<div class="col-md-12 col-xs-12 col-sm-12">
							<div class="nav navbar navbar-inverse"  style="border-radius:0px;">
									<div class="container-fluid">
										<div class="navbar-collapse collapse" id="navbar">
											<ul class="nav navbar-nav">
												<li><?= anchor('barang/list_kategori','List Kategori Barang');?></li>
												<li><?= anchor('barang/page_kategori','Insert Kategori Barang');?></li>
											</ul>
										</div>
									</div>
							</div>
							</div>
						</div>
						
						<div class='row'>
							<div class="col-md-12 col-xs-12 col-sm-12">
								<div class="page-header"><h1>Insert Kategori Barang</h1></div>
							</div>
						</div>
						
						
						<div class='row'>
						<div class="col-md-12 col-xs-12 col-sm-12">
							<?php echo form_open('barang/insertKategori'); ?>	
							<div class='form-group'>
								<div class = 'row'>
								<div class = 'col-md-8 col-xs-8 col-sm-8'>
									<div class='row'>
									<div class="col-md-12 col-xs-12 col-sm-12">
										<div class = 'col-md-3 col-xs-3 col-sm-3'>
											<label for='inputNamaKategori' class='control-label'>Kategori</label>
										</div>
										
										<div class = 'col-md-9 col-xs-9 col-sm-9'>
											<?php echo form_input(['id'=>'tbNama', 'name'=>'tbNama', 'class'=> 'form-control', 'placeholder'=> 'nama kategori barang']); ?>
										</div>
									</div>
									</div>
								</div>
								</div>
							</div>
							
							<div class='form-group'>
								<div class = 'row'>
								<div class = 'col-md-8 col-xs-8 col-sm-8'>
									<div class='row'>
									<div class="col-md-12 col-xs-12 col-sm-12">
										<div class = 'col-md-3 col-xs-3 col-sm-3'>
											<label for='inputNamaKategori' class='control-label'>Detail</label>
										</div>
										
										<div class = 'col-md-9 col-xs-9 col-sm-9'>
											<?php echo form_textarea(['id'=>'fdetail_kategori', 'name'=>'fdetail_kategori', 'class'=>'form-control', 'rows'=>5, 'placeholder'=>'detail kategori'] );?>
										</div>
									</div>
									</div>
								</div>
								</div>
							</div>
	
							<div class='form-group'>
								<div class = 'row'>
									<div class = 'col-md-12 col-md-offset-7 col-xs-12 col-xs-offset-7 col-sm-12 col-sm-offset-7'>
										<?php echo form_submit(['id'=>'btnSubmit', 'name'=>'btnSubmit', 'class'=>'btn btn-primary btn-sm'], 'Submit');?>
									</div>
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
