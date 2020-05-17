<?php
if($_SESSION['pesan']){ 
	$kd = $_GET['kd'];
	$query = $link -> query("SELECT * FROM penilai where id_penilai='$kd'");
	$data = mysqli_Fetch_Array($query);

	?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<?php if($_SESSION['pesan'] =='berhasil') {
			echo "Email dan notifikasi telah dikirim ke ".$data['nama'];;
	} 
	

	?>
		
	</div>

	<?php 
	unset($_SESSION['pesan']); }
	?>
<div class="block-header">
	<h2>DASHBOARD</h2>
</div>

<!-- Widgets -->
<div class="row clearfix">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		
		<div class="info-box bg-pink hover-expand-effect">
			<a href="?module=user">
			<div class="icon">
				<i class="material-icons">face</i>
			</div>
			<div class="content">
				<div class="text"><h4>PENILAI</h4></div>
			</div>
			</a>
		</div>
		
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-cyan hover-expand-effect">
		<a href="?module=pegawai">
			<div class="icon">
				<i class="material-icons">person_add</i>
			</div>
			<div class="content">
				<div class="text"><h4>PEGAWAI</h4></div>
			</div>
		</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-light-green hover-expand-effect">
		<a href="?module=hasil">
			<div class="icon">
				<i class="material-icons">web</i>
			</div>
			<div class="content">
				<div class="text">
				<h4>HASIL</h4></div>
			</div>
		</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-orange hover-expand-effect">
			<a href="?module=keputusan">
			<div class="icon">
				<i class="material-icons">playlist_add_check</i>
			</div>
			<div class="content">
				<div class="text"><h4>KEPUTUSAN</h4></div>
			</div>
		</a>
		</div>
	</div>
</div>
<!-- #END# Widgets -->
<div class="row clearfix">
	<!-- Task Info -->
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-12">
		<div class="card">
			<div class="header">
			<h2>SISTEM PENDUKUNG KEPUTUSAN EVALUASI PEKERJAAN PEGAWAI TIDAK TETAP</h2>
			</div>
			<div class="body">
				<div class="table-responsive">
					<P> Sistem Pendukung Keputusan Evaluasi Pekerjaan Pegawai Tidak Tetap merupakan sistem yang dikembangkan untuk mendukung pengambilan keputusan dalam evaluasi pekerjaan Pegawai tidak tetap di Pengadilan Negeri Prabumulih</P>
				</div>
			</div>
		</div>
	</div>
                <!-- #END# Task Info -->