
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('index.php/admin/dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo $title; ?></li>
			</ol>
		</div><!--/.row-->
		
		<br />
		
		<!-- INSERT CHARTS AND WHATEVER YOU WANT OVER HERE -->
		
		<div align="center" style="background: #ffffff;">
		<?php
			echo $this->gcharts->ColumnChart('populer_dilihat')->outputInto('div-populer_dilihat');
			echo $this->gcharts->div(800, 500);
			
			if($this->gcharts->hasErrors())
			{
			    echo $this->gcharts->getErrors();
			}
		?>
		</div>
		
		<br />
		
	</div>	<!--/.main-->