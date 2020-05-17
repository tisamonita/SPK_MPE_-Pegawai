<?php
if($_SESSION['pesan']){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php if($_SESSION['pesan'] =='berhasil') {
			echo "Nilai telah berhasil diinput";

		} 
		if($_SESSION['pesan'] =='ubah'){
			echo "Nilai telah berhasil Berhasil Diubah";
		}

		?>
		
	</div>

	<?php 
	unset($_SESSION['pesan']);
}
$id_nilai = $_GET['kd'];
$query2 ="SELECT * FROM subkriteria";
$hasil2 = mysqli_query($link, $query2);

	$concate1 = "SELECT pegawai.foto, pegawai.id_pegawai, pegawai.tgl_skpertama, pegawai.nama";
	$concate2 = "";
	while($KRITERIA = mysqli_fetch_array($hasil2)){
		$concate2 = $concate2.", nilai_pegawai.".$KRITERIA['kode_kriteria'];
	}
	$concate3 = " from nilai_pegawai inner join pegawai on pegawai.id_pegawai=nilai_pegawai.id_pegawai where id_nilai=".$id_nilai;
	$concate = $concate1.$concate2.$concate3;
	
$hasil1 = mysqli_query($link, $concate);
$data1 = mysqli_Fetch_Array($hasil1);

$query2 ="SELECT * FROM subkriteria";
$hasil2 = mysqli_query($link, $query2);


?>

<div class="body">
	<ol class="breadcrumb breadcrumb-col-teal">
		<li><a href="?module=home"><i class="material-icons">home</i> Home</a></li>
		<li><a href="?module=nilai"><i class="material-icons">library_books</i> Nilai</a></li>
		<li class="active"><i class="material-icons">attachment</i> Isian</li>
	</ol>

</div>
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					DATA NILAI PEGAWAI TIDAK TETAP
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



			<div class="body table-responsive">
				<div class="list-group">
					<div class="row clearfix">
						<div class="col-sm-2">
							<p class="list-group-item">
								<a href="<?= $data1['foto']; ?>" target="_blank"> <img src="<?= $data1['foto']; ?>" width="100px" ?> </a>
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
									<?php echo $data1['nama']; ?>
								</a>
							</div>
							<div class="col-sm-4">
								<p class="list-group-item">
									Tanggal SK Pertama
								</p>
							</div>
							<div class="col-sm-8">
								<a href="javascript:void(0);" class="list-group-item">
									<?php echo $data1['tgl_skpertama']; ?>
								</a>
							</div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#detailPEGAWAI<?php echo $data1['id_pegawai']; ?>">Detail</button>
							</div>
						</div>
					</div>

					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Kriteria</th>
								<th>Nilai</th>
								<th> Angka </th>
							</tr>
						</thead>
						<tbody>
							<?php
							$id = 0;
							$K = 0;
							while( $kriteria = mysqli_fetch_array($hasil2)){
								$K = $K + 1;
								$C = 'C'.$K;
								$C = $data1[$C];
								$query3 =  "SELECT * FROM bobot where id_sub='$C'";
								$query3 = mysqli_query($link, $query3);
								$query3 = mysqli_fetch_array($query3);
								$query3 = $query3['nama_sub'];


								?>

								<tr>
									<th scope="row"><?= $K; ?></th>
									<td><?= $kriteria['Nama']; ?></td>
									<td>
										<?= $query3; ?> </td>
										<td>  <?= $C; ?></td>
									</tr>

									<?php } ?>
								</tbody>

							</table>
							<!-- <a href="?module=ubahisian&kd=<?=$id_nilai; ?>"> <button type="button" class="btn btn-primary waves-effect">Ubah Penilaian</button> </a> -->
						</div>

					</div>

				</div>
			</div>
            <!-- #END# Striped Rows -->

<div class="modal fade" id="detailPEGAWAI<?php echo $data1['id_pegawai']; ?>" tabindex="-1" role="dialog">
	<?php
	$id_pegawai = $data1['id_pegawai']; 
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
											<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['jenis_kelamin']; ?>">
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
