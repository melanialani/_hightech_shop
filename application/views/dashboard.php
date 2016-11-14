
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('index.php/admin/dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo $title; ?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<!-- INSERT CHARTS AND WHATEVER YOU WANT OVER HERE -->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked basket "><use xlink:href="#stroked-basket"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($total_order); ?></div>
							<div class="text-muted">Total Orders</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($total_user); ?></div>
							<div class="text-muted">Total Users</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($total_item); ?></div>
							<div class="text-muted">Total items</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($income_day); ?></div>
							<div class="text-muted">Today's Income</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> New Orders</div>
					<div class="panel-body">
						<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					    <thead>
					        <tr>
					            <th>ID HORDER</th>
					            <th>ID BARANG</th>
					            <th>NAMA BARANG</th>
					            <th>KETERANGAN</th>
					            <th>QTY</th>
					        </tr>
					    </thead>
					   	<tbody>
							<?php foreach($allDataOrder as $row){?>
							<tr> 
								<td><?php echo $row->horder_id; ?></td>
								<td><?php echo $row->barang_id; ?></td>
								<td><?php echo $row->nama_barang; ?></td>
								<td><?php echo $row->keterangan; ?></td>
								<td><?php echo $row->qty; ?></td>
							</tr>
						   <?php }?>
					   	</tbody>
					</table>
					</div>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="panel panel-blue">
					<div class="panel-heading dark-overlay"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Calendar</div>
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
	<script type="text/javascript">
		var table;
		$(document).ready(function(){
			table = $('#table').DataTable();
			 
			$('#calendar').datepicker({});
		});
		
	</script>

	

	
	