<?php
if($_SESSION['pesan']){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php if($_SESSION['pesan'] =='berhasil') {
			echo "Pegawai Berhasil Ditambahkan";

		} 
		if($_SESSION['pesan'] =='ubah'){
			echo "Pegawai Berhasil Diubah";
		}

		if($_SESSION['pesan'] =='hapus'){
			echo "Pegawai Berhasil Dihapus";
		}

		?>
		
	</div>

	<?php 
	unset($_SESSION['pesan']);
}

$query1 = "SELECT * from pegawai";
$hasil1 = mysqli_query($link, $query1);

if ($_POST['submit']){
	$nama = $_POST['nama'];
	$nip = $_POST['nip'];
	$bagian = $_POST['bagian'];
	$pendidikan = $_POST['pendidikan'];
	$tanggal = $_POST['tanggal'];



	$allowed_ext    = array('jpg', 'jpeg', 'png', 'PNG');
	$foto_name      = $_FILES['foto']['name'];
	$tmp            = explode('.',$_FILES['foto']['name']);
	$foto_ext       = strtolower(end($tmp));

	$foto_tmp       = $_FILES['foto']['tmp_name'];

	if(in_array($foto_ext, $allowed_ext) === true){
		$lokasi = 'images/pegawai/'.$nip.$foto_name;
		move_uploaded_file($foto_tmp, $lokasi);

			$query2 = "INSERT into pegawai values('', '$nip', '$nama', '$bagian', '$pendidikan', '$tanggal', '$lokasi')";
			$hasil2 = mysqli_query($link, $query2);

			if ($hasil2) {
			$_SESSION['pesan'] = 'berhasil';
			echo '<script>window.location="?module=pegawai"</script>';
			}

	}else{
		echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
		echo $foto_name;
	}
}

if ($_POST['hapus']){
	$nip = $_POST['nip'];
	
	$query8 = "DELETE FROM pegawai WHERE nip='$nip'";
	$hasil8 = mysqli_query($link, $query8);

	if ($hasil8) {

		$_SESSION['pesan'] = 'hapus';
		echo '<script>window.location="?module=pegawai"</script>';

	}

}



?>
<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					KELOLA PEGAWAI
				</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">                                 
						<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">TAMBAH PEGAWAI</button>

					</li>
				</ul>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th> Foto </th>
								<th>Nama</th>
								<th>NIP</th>
								<th>Bagian/Bidang</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th> Foto </th>
								<th>Nama</th>
								<th>NIP</th>
								<th>Bagian/Bidang</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php while($data= mysqli_Fetch_Array($hasil1)){?>
								<tr>
									<td> <a href="<?=  $data['foto']; ?>" target=_blank > <img src="<?=  $data['foto']; ?>" width="100px" > </a> </td>
									<td><?=  $data['nama']; ?> </td>
									<td><?=  $data['nip']; ?></td>
									<td><?=  $data['bagian']; ?></td>
									<td>
										<div  class="js-sweetalert">
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#hapusPEGAWAI<?php echo $data['nip']; ?>">Hapus</button>
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#editPEGAWAI<?php echo $data['nip']; ?>">Edit</button> 
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#detailPEGAWAI<?php echo $data['nip']; ?>">Detail</button>
										</div></td>
									</tr>
									<div class="modal fade" id="hapusPEGAWAI<?php echo $data['nip']; ?>" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="defaultModalLabel">Hapus Data Pegawai</h4>
												</div>
												<div class="modal-body">
													<h5> Apa Kamu Yakin Ingin Menghapus ??</h5>
													
												</div>
												<form method="POST">
													<div class="modal-footer">
														<input type="hidden" name="nip" value="<?= $data['nip']; ?>">
														<input type="submit" required="" name="hapus" value="HAPUS" class="btn btn-link waves-effect" >
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
													</div>

												</form>
											</div>
										</div>
									</div>
									<div class="modal fade" id="editPEGAWAI<?php echo $data['nip']; ?>" tabindex="-1" role="dialog">
										<?php
										$nip = $data['nip']; 
										$query5 = "SELECT * from pegawai WHERE nip='$nip'";
										$hasil5 = mysqli_query($link, $query5);
										$hasil5 = mysqli_fetch_array($hasil5);



										?>
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="defaultModalLabel">Ubah Data Pegawai</h4>
												</div>
												<div class="modal-body">
													<!-- Vertical Layout -->
													<div class="row clearfix">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<div class="card">
																<div class="body">
																	<form method="POST" enctype="multipart/form-data" action="?module=ubahpegawai">
																		<label for="email_address">Nama</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="nama" class="form-control" value="<?= $hasil5['nama']; ?>">
																			</div>
																		</div>
																		<label for="email_address">NIP</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="nip" class="form-control" value="<?= $hasil5['nip']; ?>">
																			</div>
																		</div>

																		<input type="hidden" name="id_pegawai" value="<?= $hasil5['id_pegawai']; ?>">

																		<label for="bagian">Bagian</label>
																		<div class="form-group">
																			<div class="form-line">
																				<select name="bagian">
																				<option value="Pramubakti">Pramubakti</option>
																	<option value="Sopir">Sopir</option>
																	<option value="Satpam">Satpam</option>

																				</select>
																			</div>
																		</div>


																		<label for="password">Pendidikan</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="pendidikan" class="form-control" value="<?= $hasil5['pendidikan']; ?>">
																			</div>
																		</div>
																		<label for="password">Tanggal Terima</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="date" name="tanggal" class="form-control" value="<?= $hasil5['tgl_terima']; ?>">
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
														<input type="submit" required="" name="ubah" value="Ubah Data Pegawai" class="btn btn-link waves-effect" >
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
													</div>

												</form>
											</div>
										</div>
									</div>

									<div class="modal fade" id="detailPEGAWAI<?php echo $data['nip']; ?>" tabindex="-1" role="dialog">
										<?php
										$nip = $data['nip']; 
										$query5 = "SELECT * FROM pegawai WHERE nip='$nip'";
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

																		<label for="email_address">NIP</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['nip']; ?>">
																			</div>
																		</div>																		<input type="hidden" name="id_user" value="<?= $id_user; ?>" >


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
																		<label for="password">Tanggal Terima</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input type="text" name="username" class="form-control" disabled value="<?= $hasil5['tgl_terima']; ?>">
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
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
													</div>

												</form>
											</div>
										</div>
									</div>

									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Exportable Table -->
		<!-- Modal Dialogs ====================================================================================================================== -->
		<!-- Default Size -->
		<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Tambah Pegawai</h4>
					</div>
					<div class="modal-body">
						<!-- Vertical Layout -->
						<div class="row clearfix">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="card">
									<div class="body">
										<form method="POST" enctype="multipart/form-data" >
											<label for="email_address">Nama</label>
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="nama" id="email_address" class="form-control" placeholder="Masukkan Nama Pegawai">
												</div>
											</div>
											<label for="password">NIP</label>
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="nip" class="form-control" placeholder="Masukkan NIP Pegawai">
												</div>
											</div>

											<label for="password">Bagian/Bidang</label>
											<div class="form-group">
												<div class="form-line">
													<select name="bagian">
														<option value="Pramubakti">Pramubakti</option>
														<option value="Sopir">Sopir</option>
														<option value="Satpam">Satpam</option>
													</select>
												</div>
											</div>
											<label for="password">Pendidikan</label>
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="pendidikan" class="form-control" placeholder="Pendidikan Terakhir Pegawai">
												</div>
											</div>
											<label for="password">Tanggal DiTerima</label>
											<div class="form-group">
												<div class="form-line">
													<input type="date" name="tanggal" class="form-control" >
												</div>
											</div>
											<label for="password">Foto</label>
											<div class="form-group">
												<div class="form-line">
													<input type="file" value="Masukkan Foto" name="foto" class="form-control" >
												</div>
											</div>											<br>
										</div>
									</div>
								</div>
							</div>
							<!-- #END# Vertical Layout -->
						</div>
						<div class="modal-footer">
							<input type="submit" required="" name="submit" value="Tambah Pegawai" class="btn btn-link waves-effect" >
							<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="js/pages/ui/modals.js"></script>
		<script src="js/pages/ui/dialogs.js"></script>
		<script src="plugins/sweetalert/sweetalert.min.js"></script>
		<script src="js/pages/forms/advanced-form-elements.js"></script>

