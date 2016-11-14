
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('index.php/admin/dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo $title; ?></li>
			</ol>
		</div><!--/.row-->
		
		<br />
		
		<!-- INSERT CHARTS AND WHATEVER YOU WANT OVER HERE -->
		
		<!-- Trigger the modal with a button -->
  		<button type="button" class="btn btn-info" id="myBtn" style="margin-left: 87%;">Insert New Voucher</button>
		
		<br /><br />
		
		<table id="table_voucher" class="table table-striped table-bordered" cellspacing="0" width="100%">
		    <thead>
		        <tr>
		            <th>ID</th>
		            <th>Nama</th>
		            <th>Potongan Harga</th>
		            <th>Tanggal Awal</th>
		            <th>Tanggal Akhir</th>
		            <th>Status</th>
		            <th>Update</th>
		        </tr>
		    </thead>
		   	<tbody>
		   		<?php foreach ($tabelVoucher as $isiTabel) {
		   			echo "<tr>";
			   			echo "<th>" . $isiTabel->id . "</th>";
			   			echo "<th>" . $isiTabel->nama . "</th>";
			   			echo "<th>" . number_format($isiTabel->potongan_harga) . "</th>";
			   			echo "<th>" . $isiTabel->awal . "</th>";
			   			echo "<th>" . $isiTabel->akhir . "</th>";
			   			echo "<th>" . $isiTabel->status . "</th>";
			   			echo "<th>";
			   				echo form_open('admin/masterVoucher');
			   					echo form_hidden('id', $isiTabel->id);
			   					echo form_submit('update','Update','class="btn btn-primary"');
			   				echo form_close();
			   			echo "</th>";
		   			echo "</tr>"; }
		   		?>
		   	</tbody>
		</table>
	</div>	<!--/.main-->
	
	<script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#table_voucher').DataTable();
			
			$("#myBtn").click(function(){
		        $("#myModal").modal();
		    });
		} );
	</script>
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
	  	<div class="modal-dialog">
	  		<!-- Modal content-->
	      	<div class="modal-content">
	      		<?php echo form_open('admin/masterVoucher'); ?>
	      		
		        <div class="modal-header">
		          	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Insert New Voucher</h4>
		        </div>
		        <div class="modal-body">
		          	<h5>Nama: </h5> <input type='text' id='nama' name='nama' class='form-control'/>
		          	<br />
		          	<h5>Potongan harga: </h5> <input type='number' id='potongan_harga' name='potongan_harga' class='form-control'/>
		          	<br />
		          	<h5>Tanggal awal: </h5> <input type='date' id='awal' name='awal' class='form-control'/>
		          	<br />
		          	<h5>Tanggal akhir: </h5> <input type='date' id='akhir' name='akhir' class='form-control'/>
		        </div>
		        <div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<?php echo form_submit('insert','Insert','class="btn btn-primary"'); ?>
		        </div>
		        
		        <?php echo form_close(); ?>
	      	</div>
	    </div>
  	</div>
  	