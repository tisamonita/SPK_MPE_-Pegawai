<?php

$id_pegawai = $_GET['kd'];

$query1 ="SELECT kriteria.kode_kriteria2, kriteria.nama2, subkriteria.Nama, subkriteria.kode_kriteria from subkriteria INNER JOIN kriteria ON subkriteria.kode_induk=kriteria.kode_kriteria2";
$hasil1 = mysqli_query($link, $query1);
$jumlahkriteria = mysqli_num_rows($hasil1);



$query2 ="SELECT * FROM pegawai where id_pegawai='$id_pegawai'";
$hasil2 = mysqli_query($link, $query2);
$pegawai = mysqli_fetch_array($hasil2);
$id_pegawai = $pegawai['id_pegawai'];

$query4 = "SELECT id_nilai from nilai_pegawai WHERE id_pegawai='$id_pegawai' AND id_penilai='$id_penilai'";
$hasil4 = mysqli_query($link, $query4);
$hasil4 = mysqli_fetch_array($hasil4);

if(isset($hasil4)){
	echo '<script>window.location="?module=isian&kd='.$hasil4['id_nilai'].'"</script>';
}

if ($_POST['nilai']){
	$id = 0;
	$K = 0;

$query3 = "INSERT INTO `nilai_pegawai`(`id_nilai`, `id_pegawai`, `id_penilai`) VALUES ('','$id_pegawai','$id_penilai')";
$hasil3 = mysqli_query($link, $query3);
while($krit = mysqli_fetch_array($hasil1)){
	$C = $krit['kode_kriteria'];
	$KR= $_POST[$C];
	$query6 = "UPDATE `nilai_pegawai` SET ".$C."= ".$KR." WHERE id_pegawai=".$id_pegawai." AND id_penilai=".$id_penilai;
	echo $query6;
	$hasil6 = mysqli_query($link, $query6);
}
	

	if($hasil3){
		$_SESSION['pesan'] = 'berhasil';
		$query5 = "SELECT id_nilai from nilai_pegawai WHERE id_pegawai='$id_pegawai'";
		$hasil5 = mysqli_query($link, $query5);
		$hasil5 = mysqli_fetch_array($hasil5);
		echo '<script>window.location="?module=nilai"</script>';
	}

}


?>

<!-- Select -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					NILAI PEGAWAI TIDAK TETAP
				</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="material-icons">more_vert</i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li><a href="javascript:void(0);">Action</a></li>
							<li><a href="javascript:void(0);">Another action</a></li>
							<li><a href="javascript:void(0);">Something else here</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="body">

				<div class="list-group">
					<div class="row clearfix">
						<div class="col-sm-2">
							<p class="list-group-item">
								<a href="<?= $pegawai['foto']; ?>" target="_blank"> <img src="<?= $pegawai['foto']; ?>" width="100px" ?> </a>
							</p>
						</div>
						<div class="col-sm-10">
							<div class="col-sm-4">
								<p class="list-group-item">
									Nama
								</p>
							</div>
							<div class="col-sm-8">
								<a href="javascript:void(0);" class="list-group-item">
									<?php echo $pegawai['nama']; ?>
								</a>
							</div>
							<div class="col-sm-4">
								<p class="list-group-item">
									Tanggal SK Pertama
								</p>
							</div>
							<div class="col-sm-8">
								<a href="javascript:void(0);" class="list-group-item">
									<?php echo $pegawai['tgl_skpertama']; ?>
								</a>
							</div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#detailPEGAWAI<?php echo $pegawai['id_pegawai']; ?>">Detail</button>
							</div>
						</div>
					</div>
				</div>
				<form method="POST">
				<?php
				$id = 0;
				$K = 0;
				$echo1 = 0;
				while( $kriteria = mysqli_fetch_array($hasil1)){
					$K = $K + 1;
					 


				 ?>
				<h2 class="card-inside-title">
				<span style="color:red">
				<?php
				$echo1x = 'K'.$echo1;
				if($kriteria['kode_kriteria']==$echo1x){
					echo "";
				}
				else {
					echo $kriteria['nama2'].'<br>';
					$echo1 = $echo1 + 1;
				}
				

				?>
				 </span>
				<?=$K.' '.$kriteria['Nama'];  ?>

					
					<BR>

				</h2>
				<div class="demo-radio-button">
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="1" type="radio" class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Kurang Sekali</label>
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="2" type="radio" class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Kurang</label>
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="3" type="radio" class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Cukup</label>
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="4" type="radio" class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Baik</label>
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="5" type="radio" class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Baik Sekali</label>
				</div>
				<?php } ?>
				<br>
				<input type="submit" name="nilai" class="btn bg-green waves-effect m-r-20" value="Input Nilai">
				</form>

			</div>

		</div>
	</div>
</div>
<!-- #END# Select -->

<div class="modal fade" id="detailPEGAWAI<?php echo $pegawai['id_pegawai']; ?>" tabindex="-1" role="dialog">
	<?php
	$id_pegawai = $pegawai['id_pegawai']; 
	$query5 = "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'";
	$hasil5 = mysqli_query($link, $query5);
	$hasil5 = mysqli_fetch_array($hasil5);



	?>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Detail Pegawai</h4>
			</div>
			<div class="modal-body">
				<!-- Vertical Layout -->
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
							<div class="body">
								<form method="POST" >
									<label for="email_address">Nama</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['nama']; ?>">
										</div>
									</div>									

									<label for="jabatan">Bagian</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['bagian']; ?>">
										</div>
									</div>

									<label for="password">Pendidikan</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="username" class="form-control" disabled value="<?= $hasil5['pendidikan']; ?>">
										</div>
									</div>
									<label for="password">Tanggal SK Pertama</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="username" class="form-control" disabled value="<?= $hasil5['tgl_skpertama']; ?>">
										</div>
									</div>
									<label for="email_address">Jenis Kelamin</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['jeniskelamin']; ?>">
										</div>
									</div>					
									<label for="email_address">Alamat</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['alamat']; ?>">
										</div>
									</div>	
									<label for="email_address">Tanggal Lahir</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['tanggal_lahir']; ?>">
										</div>
									</div>					
									<br>
								</div>
							</div>
						</div>
					</div>
					<!-- #END# Vertical Layout -->
				</div>
				<div class="modal-footer">
					<button ty pe="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
				</div>

			</form>
		</div>
	</div>
</div>
