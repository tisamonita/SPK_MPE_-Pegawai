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

$query1 = "SELECT * from pegawai ORDER BY nama ASC";
$hasil1 = mysqli_query($link, $query1);

if ($_POST['submit']){
	$nama = $_POST['nama'];
	$bagian = $_POST['bagian'];
	$pendidikan = $_POST['pendidikan'];
	$tanggal = $_POST['tanggal'];
	$tanggallahir = $_POST['tanggallahir'];
	$alamat = $_POST['alamat'];
	$jeniskelamin = $_POST['jeniskelamin'];
	$allowed_ext    = array('jpg', 'jpeg', 'png', 'PNG');
	$foto_name      = $_FILES['foto']['name'];
	$tmp            = explode('.',$_FILES['foto']['name']);
	$foto_ext       = strtolower(end($tmp));

	$foto_tmp       = $_FILES['foto']['tmp_name'];

	if(in_array($foto_ext, $allowed_ext) === true){
		$lokasi = 'images/pegawai/'.$nama.$foto_name;
		move_uploaded_file($foto_tmp, $lokasi);

		$query2 = "INSERT into pegawai values('', '$nama', '$bagian', '$pendidikan', '$jeniskelamin', '$tanggal', '$lokasi', '$alamat', '$tanggallahir')";
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
	$id_pegawai = $_POST['id_pegawai'];
	
	$query8 = "DELETE FROM pegawai WHERE id_pegawai='$id_pegawai'";
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
					DATA PEGAWAI TIDAK TETAP
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
								<th> Tanggal SK Pertama</th>
								<th>Bagian/Bidang</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th> Foto </th>
								<th>Nama</th>
								<th> Tanggal SK Pertama</th>
								<th>Bagian/Bidang</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php while($data= mysqli_Fetch_Array($hasil1)){?>
								<tr>
									<td> <a href="<?=  $data['foto']; ?>" target=_blank > <img src="<?=  $data['foto']; ?>" width="100px" > </a> </td>
									<td><?=  $data['nama']; ?> </td>
									<td><?=  $data['tgl_skpertama']; ?></td>
									<td><?=  $data['bagian']; ?></td>
									<td>
										<div  class="js-sweetalert">
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#hapusPEGAWAI<?php echo $data['id_pegawai']; ?>">Hapus</button>
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-id="<?= $data['id_pegawai']; ?>" data-target="#editPEGAWAI">Edit</button> 
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#detailPEGAWAI<?php echo $data['id_pegawai']; ?>">Detail</button>
										</div></td>
									</tr>
									<div class="modal fade" id="hapusPEGAWAI<?php echo $data['id_pegawai']; ?>" tabindex="-1" role="dialog">
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
														<input type="hidden" name="id_pegawai" value="<?= $data['id_pegawai']; ?>">
														<input type="submit" required="" name="hapus" value="HAPUS" class="btn btn-link waves-effect" >
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
													</div>

												</form>
											</div>
										</div>
									</div>

									<div class="modal fade" id="detailPEGAWAI<?php echo $data['id_pegawai']; ?>" tabindex="-1" role="dialog">
										<?php
										$id_pegawai = $data['id_pegawai']; 
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
																	<label for="password">Foto</label>
																		<div class="form-group">
																			<div class="form-line">
																				<img src="<?=$hasil5['foto']; ?>" width="120px">
																			</div>
																		</div>		
																		<label for="email_address">Nama</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input type="text" disabled name="nama" id="email_address" class="form-control" value="<?= $hasil5['nama']; ?>">
																			</div>
																		</div>
																		<label for="email_address">Bagian</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input type="text" disabled name="nama" id="email_address" class="form-control" value="<?= $hasil5['bagian']; ?>">
																			</div>
																		</div>
																		
																		<label for="password">Pendidikan</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input disabled type="text" value="<?= $hasil5['pendidikan']; ?>" name="pendidikan" class="form-control" >
																			</div>
																		</div>
																		<label for="password">Tanggal SK Pertama</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input disabled value="<?= $hasil5['tgl_skpertama']; ?>" type="date" name="tanggal" class="form-control" >
																			</div>
																		</div>
																		<label for="password">Jenis Kelamin</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input disabled value="<?= $hasil5['jeniskelamin']; ?>" type="text" name="tanggal" class="form-control" >
																			</div>
																		</div>
																		<label for="password">Alamat</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input disabled type="text" name="alamat" class="form-control" value="<?= $hasil5['alamat']; ?>" placeholder="Masukkan Alamat Pegawai">
																			</div>
																		</div>
																		<label for="password">Tanggal Lahir</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input disabled type="date" value="<?= $hasil5['tanggal_lahir']; ?>" name="tanggallahir" class="form-control" >
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
											<label for="password">Tanggal SK Pertama</label>
											<div class="form-group">
												<div class="form-line">
													<input type="date" name="tanggal" class="form-control" >
												</div>
											</div>
											<label for="password">Jenis Kelamin</label>
											<div class="form-group">
												<div class="form-line">
													<select name="jeniskelamin">
														<option value="Perempuan">Perempuan</option>
														<option value="Laki-laki">Laki-laki</option>
													</select>
												</div>
											</div>
											<label for="password">Alamat</label>
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat Pegawai">
												</div>
											</div>
											<label for="password">Tanggal Lahir</label>
											<div class="form-group">
												<div class="form-line">
													<input type="date" name="tanggallahir" class="form-control" >
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

		<div class="modal fade" id="editPEGAWAI" tabindex="-1" role="dialog">
			<?php
			$id_pegawai = $data['id_pegawai']; 
			$query5 = "SELECT * from pegawai WHERE id_pegawai='$id_pegawai'";
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
									<div class="fetched-data"> </div>

				</div>
			</div>
		</div>

	<script src="plugins/jquery/jquery.min.js"></script>
	 <script type="text/javascript">

    $(document).ready(function(){
        $('#editPEGAWAI').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            
            $.ajax({
                type : 'post',
                url : 'admin/editpegawai.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });

         });
    });
    </script>

		<script src="js/pages/ui/modals.js"></script>
		<script src="js/pages/ui/dialogs.js"></script>
		<script src="plugins/sweetalert/sweetalert.min.js"></script>
		<script src="js/pages/forms/advanced-form-elements.js"></script>

