<?php

if($_SESSION['pesan']){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<?php if($_SESSION['pesan'] =='berhasil') {
			echo "Tim Penilai Berhasil Ditambahkan";
	} 
		if($_SESSION['pesan'] =='ubah'){
			echo "Tim Penilai Berhasil Diubah";
		}

		if($_SESSION['pesan'] =='hapus'){
			echo "Tim Penilai Berhasil Dihapus";
		}
		if($_SESSION['pesan'] =='wewenanghapus'){
			echo "Ketua Tim Penilai Berhasil Dihapus";
		}
		if($_SESSION['pesan'] =='wewenang'){
			echo "Ketua Tim Penilai Berhasil Ditetapkan";
		}

	?>
		
	</div>

	<?php 
	unset($_SESSION['pesan']);
}

if ($_POST['submit']){
	$nama = $_POST['nama'];
	$jabatan = $_POST['jabatan'];
	$email = $_POST['email'];
	if($jabatan=='Ketua Pengadilan'){
		$role = 'ketua';
	}
	else {
		$role = 'penilai';
	}
	$username = $_POST['username'];
	$password = $_POST['password'];

	$password = md5($password);

	$query3 = "SELECT max(id_user) as id from user";
	$hasil3 = mysqli_query($link, $query3);
	$hasil3 = mysqli_fetch_array($hasil3);
	$id_user = $hasil3['id'];
	$id_user = $id_user + 1;

	$query1 = "INSERT into user values('$id_user', '$username', '$password', '$role', '')";
	$hasil1 = mysqli_query($link, $query1);

	$query2 = "INSERT into penilai values('', '$id_user', '$nama', '$jabatan','', '$email')";
	$hasil2 = mysqli_query($link, $query2);

	if ($hasil2) {

		$_SESSION['pesan'] = 'berhasil';
		echo '<script>window.location="?module=user"</script>';

	}

}

if ($_POST['ubah']){
	$id_user = $_POST['id_user'];
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$jabatan = $_POST['jabatan'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = $_POST['password'];

	if(empty($_POST['password'])){
		$query6 = "UPDATE user set username='$username' WHERE id_user='$id_user'";
	}
	if($password != ""){
		$password = md5($password);
		$query6 = "UPDATE user set username='$username', password='$password' WHERE id_user='$id_user'";
	}

	$hasil6 = mysqli_query($link, $query6);

	$query7 = "UPDATE penilai set nama='$nama', jabatan='$jabatan', email='$email' WHERE id_user='$id_user'";
	$hasil7 = mysqli_query($link, $query7);

	if ($hasil7) {

		$_SESSION['pesan'] = 'ubah';
		echo '<script>window.location="?module=user"</script>';

	}

}

if ($_POST['hapus']){
	$id_user = $_POST['id'];
	
	$query8 = "DELETE FROM user WHERE id_user='$id_user'";
	$hasil8 = mysqli_query($link, $query8);

	if ($hasil8) {

		$_SESSION['pesan'] = 'hapus';
		echo '<script>window.location="?module=user"</script>';

	}

}

if ($_POST['hapusketua']){
	$id_user = $_POST['idketua'];
	
	$query8 = "UPDATE user set role_2='' WHERE id_user='$id_user'";
	$hasil8 = mysqli_query($link, $query8);

	if ($hasil8) {

		$_SESSION['pesan'] = 'wewenanghapus';
		echo '<script>window.location="?module=user"</script>';

	}

}
if ($_POST['tetapkan']){
	$id_user = $_POST['ketua'];
	
	$query8 = "UPDATE user set role_2='ketuapenilai' WHERE id_user='$id_user'";
	$hasil8 = mysqli_query($link, $query8);

	if ($hasil8) {

		$_SESSION['pesan'] = 'wewenang';
		echo '<script>window.location="?module=user"</script>';

	}

}

$query4 = "SELECT user.id_user, penilai.nama, penilai.email, penilai.jabatan, user.username from penilai inner join user on user.id_user=penilai.id_user";
$hasil4 = mysqli_query($link, $query4);

$query9 = "SELECT user.id_user,user.role_2, penilai.nama, penilai.email, penilai.jabatan, user.username from penilai inner join user on user.id_user=penilai.id_user WHERE user.role_2='ketuapenilai'";
$query9 = mysqli_query($link, $query9);
$ketuapenilai = mysqli_num_rows($query9);


?>

<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					TIM PENILAI 
				</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">                                 
						<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">TAMBAH TIM PENILAI</button>

					</li>
				</ul>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Username</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Username</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php while($data = mysqli_fetch_array($hasil4)){
								if($data['id_user']!= 1){

								?>
								<tr>
									<td><?= $data['nama']; ?></td>
									<td><?= $data['jabatan']; ?></td>
									<td><?= $data['username']; ?></td>
									<td>
										<div  class="js-sweetalert">
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#hapusPENILAI<?php echo $data['id_user']; ?>">Hapus</button>
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#editPENILAI<?php echo $data['id_user']; ?>">Edit</button> 
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#detailPENILAI<?php echo $data['id_user']; ?>">Detail</button>

										</div></td>
									</tr>
									
									<div class="modal fade" id="editPENILAI<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog">
										<?php
										$id_user = $data['id_user']; 
										$query5 = "SELECT penilai.id_user, penilai.nama, penilai.email, penilai.jabatan, user.username from penilai inner join user on user.id_user=penilai.id_user WHERE user.id_user='$id_user'";
										$hasil5 = mysqli_query($link, $query5);
										$hasil5 = mysqli_fetch_array($hasil5);



										?>
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="defaultModalLabel">Ubah Tim Penilai</h4>
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
																			<div class="form-line">
																				<input type="text" name="nama" class="form-control" value="<?= $hasil5['nama']; ?>">
																			</div>
																		</div>
																		<input type="hidden" name="id_user" value="<?= $id_user; ?>" >

																		<label for="jabatan">Jabatan</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="jabatan" class="form-control" value="<?= $hasil5['jabatan']; ?>">
																			</div>
																		</div>

																		<label for="password">Username</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="username" class="form-control" value="<?= $hasil5['username']; ?>">
																			</div>
																		</div>
																		<label for="password">Email</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="email" name="email" class="form-control" value="<?= $hasil5['email']; ?>">
																			</div>
																		</div>
																		<label for="password">Password</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="password" name="password" class="form-control" placeholder="Masukkan Password Sementara">
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
														<input type="submit" required="" name="ubah" value="Ubah Tim Penilai" class="btn btn-link waves-effect" >
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
													</div>

												</form>
											</div>
										</div>
									</div>

				<div class="modal fade" id="detailPENILAI<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog">
										<?php
										$id_user = $data['id_user']; 
										$query5 = "SELECT penilai.id_user, penilai.nama, penilai.email, penilai.jabatan, user.username from penilai inner join user on user.id_user=penilai.id_user WHERE user.id_user='$id_user'";
										$hasil5 = mysqli_query($link, $query5);
										$hasil5 = mysqli_fetch_array($hasil5);



										?>
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="defaultModalLabel">Detail Tim Penilai</h4>
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
																		<input type="hidden" name="id_user" value="<?= $id_user; ?>" >


																		<label for="jabatan">Jabatan</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['jabatan']; ?>">
																			</div>
																		</div>
																			<label for="jabatan">Email</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input type="email" name="nama" class="form-control" disabled value="<?= $hasil5['email']; ?>">
																			</div>
																		</div>

																		<label for="password">Username</label>
																		<div class="form-group">
																			<div class="form-line disabled">
																				<input type="text" name="username" class="form-control" disabled value="<?= $hasil5['username']; ?>">
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

					<div class="modal fade" id="hapusPENILAI<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="defaultModalLabel">Hapus Tim Penilai</h4>
												</div>
												<div class="modal-body">
													<h5> Apa Kamu Yakin Ingin Menghapus ??</h5>
													
													</div>
													<form method="POST">
													<div class="modal-footer">
														<input type="hidden" name="id" value="<?= $data['id_user']; ?>">
														<input type="submit" required="" name="hapus" value="HAPUS" class="btn btn-link waves-effect" >
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
													</div>

												</form>
											</div>
										</div>
									</div>

									<?php
									}
								} ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- #END# Exportable Table -->

<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					KETUA TIM PENILAI
				</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">      
					<?php
					if($ketuapenilai == 0){ ?>                         
						<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#tetapkan">TETAPKAN KETUA TIM PENILAI</button>
						<?php }
					?>  
					</li>
				</ul>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Username</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Username</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php while ($dataketua = mysqli_fetch_array($query9)) {
							
								?>
								<tr>
									<td><?= $dataketua['nama']; ?></td>
									<td><?= $dataketua['jabatan']; ?></td>
									<td><?= $dataketua['username']; ?></td>
									<td>
										<div  class="js-sweetalert">
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#hapusKETUA<?php echo $dataketua['id_user']; ?>">Cabut Wewenang Ketua</button>
										</div></td>
									</tr>
									
					<div class="modal fade" id="hapusKETUA<?php echo $dataketua['id_user']; ?>" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="defaultModalLabel">Cabut Wewenang sebagai Ketua tim penilai</h4>
												</div>
												<div class="modal-body">
													<h5> Apa Kamu Yakin ??</h5>
													
													</div>
													<form method="POST">
													<div class="modal-footer">
														<input type="hidden" name="idketua" value="<?= $dataketua['id_user']; ?>">
														<input type="submit" required="" name="hapusketua" value="YAKIN" class="btn btn-link waves-effect" >
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
													</div>

												</form>
											</div>
										</div>
									</div>

									<?php

								} ?>

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
					<h4 class="modal-title" id="defaultModalLabel">Tambah Tim Penilai</h4>
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
											<div class="form-line">
												<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Tim Penilai">
											</div>
										</div>


										<label for="password">Jabatan</label>
										<div class="form-group">
											<div class="form-line">
												<select name="jabatan" >
													<option value="Ketua Pengadilan">Ketua Pengadilan</option>
													<option value="Wakil Pengadilan">Wakil Pengadilan</option>
													<option value="Sekretaris Pengadilan">Sekretaris Pengadilan</option>
													<option value="Kasubbag Kepegawaian dan Ortala">Kasubbag Kepegawaian dan Ortala</option>
													<option value="Kasubbag Perencanaan, TI dan Pelaporan">Kasubbag Perencanaan, TI dan Pelaporan</option>
													<option value="Kasubbag Umum dan Keuangan">Kasubbag Umum dan Keuangan</option>
													<option value="Hakim">Hakim</option>
													<option value="Panitera Muda Pidana">Panitera Muda Pidana</option>
													<option value="Panitera Muda Perdata">Panitera Muda Perdata</option>
													<option value="Panitera Muda Hukum">Panitera Muda Hukum</option>
												</select>
											</div>
										</div>
										<label for="password">Username</label>
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="username" class="form-control" placeholder="Masukkan Username">
											</div>
										</div>
											<label for="password">Email</label>
										<div class="form-group">
											<div class="form-line">
												<input type="email" name="email" class="form-control" placeholder="Masukkan Email">
											</div>
										</div>
										
										<label for="password">Password</label>
										<div class="form-group">
											<div class="form-line">
												<input type="password" name="password" class="form-control" placeholder="Masukkan Password Sementara">
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
						<input type="submit" required="" name="submit" value="Tambah Tim Penilai" class="btn btn-link waves-effect" >
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Default Size -->
	<div class="modal fade" id="tetapkan" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Tetapkan Ketua Tim Penilai</h4>
				</div>
				<div class="modal-body">
					<!-- Vertical Layout -->
					<div class="row clearfix">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="card">
								<div class="body">
									<form method="POST" >
										<label for="password">Pilih Penilai Sebagai Ketua Tim Penilai</label>
										<div class="form-group">
											<div class="form-line">
											<?php

											$query10 = "SELECT * FROM penilai";
											$query10 = mysqli_query($link, $query10);

											?>
												<select name="ketua" >
												<?php while ($dataa = mysqli_fetch_array($query10)) { ?>
													<option value="<?= $dataa['id_user']; ?>"><?= $dataa['nama']; ?></option>
											<?php } ?>
													
												</select>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<!-- #END# Vertical Layout -->
					</div>
					<div class="modal-footer">
						<input type="submit" required="" name="tetapkan" value="Tetapkan Ketua Tim Penilai" class="btn btn-link waves-effect" >
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

