
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
  		<button type="button" class="btn btn-info" id="myBtn" style="margin-left: 87%;">Insert New Admin</button>
		
		<br /><br />
		
		<table id="table_user" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
		        <tr>
		            <th>Username</th>
		            <th>Nama</th>
		            <th>Email</th>
		            <th>Tanggal Lahir</th>
		            <th>Alamat</th>
		            <th>Telepon</th>
		            <th>Role</th>
		        </tr>
		    </thead>
		   	<tbody>
		   		<?php foreach ($tabelUser as $isiTabel) {
		   			echo "<tr>";
			   			echo "<th>" . $isiTabel->username . "</th>";
			   			echo "<th>" . $isiTabel->nama_depan . " " . $isiTabel->nama_belakang . "</th>";
			   			echo "<th>" . $isiTabel->email . "</th>";
			   			echo "<th>" . $isiTabel->tanggal_lahir . "</th>";
			   			if ($isiTabel->alamat != NULL){
			   				if ($isiTabel->kota != NULL && $isiTabel->provinsi != NULL){
								echo "<th>" . $isiTabel->alamat . ", " . $isiTabel->kota . ", " . $isiTabel->provinsi . "</th>";
							} else if ($isiTabel->kota != NULL && $isiTabel->provinsi == NULL){
								echo "<th>" . $isiTabel->alamat . ", " . $isiTabel->kota . "</th>";
							} else if ($isiTabel->kota == NULL && $isiTabel->provinsi != NULL){
								echo "<th>" . $isiTabel->alamat . ", " . $isiTabel->provinsi . "</th>";
							} else if ($isiTabel->kota == NULL && $isiTabel->provinsi == NULL){
								echo "<th>" . $isiTabel->alamat . "</th>";
							}
						} else echo "<th></th>";
			   			echo "<th>" . $isiTabel->telepon . "</th>";
			   			echo "<th>" . $isiTabel->role . "</th>";
		   			echo "</tr>"; }
		   		?>
		   	</tbody>
		</table>
		
		<br />
		
	</div>	<!--/.main-->
	
	<script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#table_user').DataTable();
			
			$("#myBtn").click(function(){
		        $("#myModal").modal();
		    });
		});
	</script>

	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
	  	<div class="modal-dialog">
	  		<!-- Modal content-->
	      	<div class="modal-content">
	      		<?php echo form_open('admin/masterUser'); ?>
	      		
		        <div class="modal-header">
		          	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Insert New Admin</h4>
		        </div>
		        <div class="modal-body">
		          	<h5>Username: </h5> <input type='text' id='new_username' name='new_username' class='form-control'/>
		          	<br />
		          	<h5>Password: </h5> <input type='password' id='new_password' name='new_password' class='form-control'/>
		        </div>
		        <div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<?php echo form_submit('insert','Insert','class="btn btn-primary"');?>
		        </div>
		        
		        <?php echo form_close(); ?>
	      	</div>
	    </div>
  	</div>
  	