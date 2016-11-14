
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<div class="navbar-brand"><span>High-Tech Shop</span> Admin</div>
				<div class="user-menu" style="color: #ffffff;"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php echo $username; ?></div>
			</div><!-- /.navbar-header -->
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li><a href="<?php echo base_url('index.php/admin/dashboard'); ?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li><a href="<?php echo base_url('index.php/admin/masterBarang'); ?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Master Barang</a></li>
			<li><a href="<?php echo base_url('index.php/admin/masterKategori'); ?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Master Kategori</a></li>
			<li><a href="<?php echo base_url('index.php/admin/masterOrder'); ?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Master Order</a></li>
			<li><a href="<?php echo base_url('index.php/admin/masterUser'); ?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Master User</a></li>
			<li><a href="<?php echo base_url('index.php/admin/masterVoucher'); ?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Master Voucher</a></li>
			
			<li role="presentation" class="divider"></li>
			
			<li><a href="<?php echo base_url('index.php/admin/laporanDilihat'); ?>"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Produk yang sering dilihat</a></li>
			<li><a href="<?php echo base_url('index.php/admin/laporanDibeli'); ?>"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Produk yang sering dibeli</a></li>
			<li><a href="<?php echo base_url('index.php/admin/laporanTransaksi'); ?>"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Transaksi - Kota</a></li>
			<li><a href="<?php echo base_url('index.php/admin/laporanUser'); ?>"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> User - Kota</a></li>
			<li><a href="<?php echo base_url('index.php/admin/laporanPemasukan'); ?>"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Laporan Pemasukan</a></li>
			
			<li role="presentation" class="divider"></li>
			
			<li><a href="<?php echo base_url('index.php/admin/login'); ?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
