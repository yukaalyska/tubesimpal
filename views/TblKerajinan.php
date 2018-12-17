<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Rizky</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/icheck/flat/blue.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/select2.css" />		
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/unicorn.css" />
		<!--[if lt IE 9]>
		<script type="text/javascript" src="js/respond.min.js"></script>
		<![endif]-->
	</head>	
	<body data-color="grey" class="flat">
		<div id="wrapper">
			<div id="header">
				<h1><a href="./index.html">Admin Rizky</a></h1>	
				<a id="menu-trigger" href="#"><i class="fa fa-bars"></i></a>	
			</div>
			
			<!--Menu Bar-->
			<div id="user-nav">
	            <ul class="btn-group">
	                <li class="btn"><a title="" href="login.html"><i class="fa fa-share"></i> <span class="text">Keluar</span></a></li>
	            </ul>
	        </div>
	       
		   <!--PilihanWarnaTema-->
	       <div id="switcher">
	            <div id="switcher-inner">
	                <h3>Theme Options</h3>
	                <h4>Colors</h4>
	                <p id="color-style">
	                    <a data-color="orange" title="Orange" class="button-square orange-switcher" href="#"></a>
	                    <a data-color="turquoise" title="Turquoise" class="button-square turquoise-switcher" href="#"></a>
	                    <a data-color="blue" title="Blue" class="button-square blue-switcher" href="#"></a>
	                    <a data-color="green" title="Green" class="button-square green-switcher" href="#"></a>
	                    <a data-color="red" title="Red" class="button-square red-switcher" href="#"></a>
	                    <a data-color="purple" title="Purple" class="button-square purple-switcher" href="#"></a>
	                    <a href="#" data-color="grey" title="Grey" class="button-square grey-switcher"></a>
	                </p>
	                <!--
	                <h4>Background Patterns</h4>
	                <h5>for boxed version</h5>
	                <p id="pattern-switch">
	                    <a data-pattern="pattern1" style="background-image:url('assets/img/patterns/pattern1.png');" class="button-square" href="#"></a>
	                    <a data-pattern="pattern2" style="background-image:url('assets/img/patterns/pattern2.png');" class="button-square" href="#"></a>
	                    <a data-pattern="pattern3" style="background-image:url('assets/img/patterns/pattern3.png');" class="button-square" href="#"></a>
	                    <a data-pattern="pattern4" style="background-image:url('assets/img/patterns/pattern4.png');" class="button-square" href="#"></a>
	                    <a data-pattern="pattern5" style="background-image:url('assets/img/patterns/pattern5.png');" class="button-square" href="#"></a>
	                    <a data-pattern="pattern6" style="background-image:url('assets/img/patterns/pattern6.png');" class="button-square" href="#"></a>
	                    <a data-pattern="pattern7" style="background-image:url('assets/img/patterns/pattern7.png');" class="button-square" href="#"></a>
	                    <a data-pattern="pattern8" style="background-image:url('assets/img/patterns/pattern8.png');" class="button-square" href="#"></a>
	                </p>-->
	                <h4 class="visible-lg">Layout Type</h4>
	                <p id="layout-type">
	                	<a data-option="flat" class="button" href="#">Flat</a>
	                    <a data-option="old" class="button" href="#">Old</a>                    
	                </p>
	            </div>
	            <div id="switcher-button">
	                <i class="fa fa-cogs"></i>
	            </div>
	        </div>
			
			<!--MenuSamping-->
			<div id="sidebar">
				<ul>
					<li class="active"><a href="<?php echo base_url(); ?>index.php/c_home/index"><i class="fa fa-home"></i> <span>Home</span></a></li>
					<li class="submenu">
						<a href="#"><i class="fa fa-th"></i> <span>Tabel Tata Tertib</span> <i class="arrow fa fa-chevron-right"></i></a>
						<ul>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index2">Aspek Kerapihan</a></li>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index3">Aspek Kerajinan</a></li>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index4">Aspek Kelakuan</a></li>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index5">Lain-lain</a></li>
						</ul>
					</li>
					<li class="submenu">
						<a href="#"><i class="fa fa-th-list"></i> <span>Menu Pelanggaran</span> <i class="arrow fa fa-chevron-right"></i></a>
						<ul>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index6">Input Pelanggaran</a></li>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index7">Laporan</a></li>
						</ul>
					</li>
					<li class="submenu">
						<a href="#"><i class="fa fa-th-list"></i> <span>Menu Prestasi</span> <i class="arrow fa fa-chevron-right"></i></a>
						<ul>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index8">Input Prestasi</a></li>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index9">Laporan</a></li>							
						</ul>
					</li>
					<li class="submenu">
						<a href="#"><i class="fa fa-th-list"></i> <span>Berkas Konseling</span> <i class="arrow fa fa-chevron-right"></i></a>
						<ul>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index10">Download Berkas</a></li>
							<li><a href="<?php echo base_url() ?>index.php/c_home/index11">Upload Berkas</a></li>
						</ul>
					</li>
				</ul>
			</div>
		
		<!--Content-->
		<div id="content">
			<div id="content-header">
				<h1>Tabel Tata Tertib</h1>
			</div>
			<div id="breadcrumb">
				<a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
				<a href="#" class="current">Tabel Tata Tertib</a>
			</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<div class="alert alert-info">
								<strong>Berikut adalah Tabel Aspek Kerajinan. Klik salah satu baris untuk edit atau hapus tabel !</strong>
								<a href="#" data-dismiss="alert" class="close">×</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="fa fa-th"></i>
								</span>
								<h5>Aspek Kerajinan</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped table-hover data-table">
									<thead>
									<tr>
									<th>Jenis Pelanggaran</th>									
									<th>Sanksi</th>
									<th>Poin/Bobot</th>
									</tr>
									</thead>
									<tbody>
									<tr>
									<td>Memakai baju tidak rapi/tidak dimasukkan</td>
									<td>Merapikan baju</td>
									<td>5</td>
									</tr>
									<tr>
									<td>Tidak memakai kaos kaki putih</td>
									<td>Teguran dan Pembinaan</td>
									<td>5</td>
								</table>
							</div>
						</div>
						<button class="btn btn-primary">Edit Tabel</button>
					</div>
				</div>
		</div>
		<div class="row">
			<div id="footer" class="col-xs-12">
				Aplikasi Pengelolaan Data Non-Akademik Berbasis Web
			</div>
		</div>
		
            
            <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
            <script src="<?php echo base_url(); ?>js/jquery-ui.custom.js"></script>
            <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
            <script src="<?php echo base_url(); ?>js/jquery.icheck.min.js"></script>
            <script src="<?php echo base_url(); ?>js/select2.min.js"></script>
            <script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
            
            <script src="<?php echo base_url(); ?>js/jquery.nicescroll.min.js"></script>
            <script src="<?php echo base_url(); ?>js/unicorn.js"></script>
            <script src="<?php echo base_url(); ?>js/unicorn.tables.js"></script>
	</body>
</html>
