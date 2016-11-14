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
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class='row'>
								<div class="col-lg-12">
								<div class="nav navbar navbar-inverse"  style="border-radius:0px;">
										<div class="container-fluid">
											<div class="navbar-collapse collapse" id="navbar">

												<ul class="nav navbar-nav">
													<li><?= anchor('barang/listOrder','List Order');?></li>
													<li><?= anchor('barang/listLogOrder','List Log Order');?></li>
												</ul>
											</div>
										</div>
								</div>
								</div>
							</div>
							
							<div class='row'>
								<div class="col-lg-12">
									<div class="page-header"><h1>Daftar List Log Order</h1></div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12">
									<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
									  <thead>
										<tr>
										  <th>LogOrder Id</th>
										  <th>Horder Id</th>
										  <th>Status</th>
										  <th>Tanggal</th>
										  <th>Pengaturan</th>
										</tr>
									  </thead>
									  <tbody>
									  </tbody>
									</table>
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
				<h5 class="page-header"><?php //echo $coba; ?></h5>
			</div>
		</div>
</div>	<!--/.main-->
<script type="text/javascript">
	var table;
	$(document).ready(function() {
	  table = $('#table').DataTable({ 
		
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"bFilter": false,
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": "<?php echo site_url('barang/ajax_logOrder') ?>",
			"type": "POST"
		},

		//Set column definition initialisation properties.
		"columnDefs": [
			{ 
			/*--------------------------------------------------------
				set kolom yang fieldnya tidak dapat dilakukan sorting, 
				-1 berarti dari field paling akhir dri data table
			---------------------------------------------------------*/	
			  "targets": [-1], 
			  "orderable": false //set not orderable
			},
			]
	  });
	  
	});
	function reload_table()
	{
		table.ajax.url("<?php echo site_url('barang/ajax_logOrder') ?>");
		table.ajax.reload(null,false); //reload datatable ajax
	}
</script>

