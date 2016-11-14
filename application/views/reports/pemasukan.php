
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('index.php/admin/dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo $title; ?></li>
			</ol>
		</div><!--/.row-->
		
		<br />
		
		<!-- INSERT CHARTS AND WHATEVER YOU WANT OVER HERE -->
		
		<div style="background: #ffffff;">
			<br />
			<?php
				$arrMonth = NULL;
				$arrYear = NULL;
				
				$arrMonth[0] = "-";
				$arrMonth[1] = "Januari";
				$arrMonth[2] = "Februari";
				$arrMonth[3] = "Maret";
				$arrMonth[4] = "April";
				$arrMonth[5] = "Mei";
				$arrMonth[6] = "Juni";
				$arrMonth[7] = "Juli";
				$arrMonth[8] = "Agustus";
				$arrMonth[9] = "September";
				$arrMonth[10] = "Oktober";
				$arrMonth[11] = "November";
				$arrMonth[12] = "Desember";
				
				$arrYear[0] = "-";
				for ($i = $min_year; $i <= $max_year; $i++){
					$arrYear[$i] = $i;
				}
				
				echo form_open('admin/laporanPemasukan'); 
					echo "<table width='450px' align='center'><tr>";
					echo "<th><b>Lihat pemasukan pada: </b></th>";
					echo "<th>" . form_dropdown('month', $arrMonth, $month, 'class="form-control" style="width:120px;"') . " </th>";
					echo "<th>" . form_dropdown('year', $arrYear, $year, 'class="form-control" style="width:90px;"') . " </th>";
					echo "<th>" . form_submit(['id'=>'go','name'=>'go','value'=>'Go!','class'=>'btn btn-primary']) . " </th>";
					echo "</tr></table>";
				echo form_close();
			?>
		</div>
		
		<div align="center" style="background: #ffffff;">
			<?php
				echo $this->gcharts->LineChart('Pemasukan')->outputInto('div-pemasukan');
				echo $this->gcharts->div(1000, 500);
				
				if($this->gcharts->hasErrors())
				{
				    echo $this->gcharts->getErrors();
				}
			?>
		</div>
		
		<br />
		
	</div>	<!--/.main-->