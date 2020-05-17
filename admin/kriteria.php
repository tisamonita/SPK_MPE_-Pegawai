<?php

if($_SESSION['pesan']){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<?php if($_SESSION['pesan'] =='berhasil') {
			echo "Kriteria Berhasil Ditambahkan";
	} 
		if($_SESSION['pesan'] =='ubah'){
			echo "Kriteria Berhasil Diubah";
		}

		if($_SESSION['pesan'] =='hapus'){
			echo "Kriteria Berhasil Dihapus";
		}

	?>
		
	</div>

	<?php 
	unset($_SESSION['pesan']);
}

$max = "SELECT max(id_kriteria) as idskrng from subkriteria";
$max = mysqli_query($link, $max);
$max = mysqli_fetch_Array($max);
$idskrng = $max['idskrng'];

if ($_POST['submit']){
	$nama = $_POST['nama'];
	$bobot = $_POST['bobot'];
	$induk = $_POST['induk'];
	$idkriteria = $idskrng + 1;
	$kodekriteria = 'C'.$idkriteria;


$query3 = "INSERT INTO subkriteria values('$idkriteria', '$kodekriteria','$induk','$nama', '$bobot')";
$query3 = mysqli_query($link, $query3);

$queryex = "ALTER TABLE nilai_pegawai ADD COLUMN IF NOT EXISTS ".$kodekriteria." int";
$queryex = mysqli_query($link, $queryex);

if ($query3) {
			$_SESSION['pesan'] = 'berhasil';
			echo '<script>window.location="?module=kriteria"</script>';
		}
	

}

if ($_POST['ubah']){
	$id_kriteria = $_POST['id_kriteria'];
	$nama = $_POST['nama'];
	$bobot = $_POST['bobot'];
	$induk = $_POST['induk'];
	echo "MASUKK";
	$query3 = "UPDATE subkriteria SET nama='$nama', bobot='$bobot', kode_induk='$induk' WHERE id_kriteria='$id_kriteria'";
	$query3= mysqli_query($link, $query3);
	if($query3)
		{
			$_SESSION['pesan'] = 'ubah';
		// echo '<script>window.location="?module=kriteria"</script>';
		}
}


if ($_POST['hapus']){
	$id_kriteria = $_POST['id'];
	$kodekriteria = 'C'.$id_kriteria;
	
	$query4 = "DELETE FROM subkriteria WHERE id_kriteria='$id_kriteria'";
	$query4 = mysqli_query($link, $query4);

	$queryex = "ALTER TABLE nilai_pegawai DROP COLUMN ".$kodekriteria." ";
	$queryex = mysqli_query($link, $queryex);

	if ($query4) {

		$_SESSION['pesan'] = 'hapus';
		echo '<script>window.location="?module=kriteria"</script>';

	}

}

if ($_POST['submitinduk']){
	$nama2 = $_POST['nama2'];
	$queryex = "SELECT max(kode_kriteria2) as kdskrng from kriteria";
	$queryex = mysqli_query($link, $queryex);
	$queryex = mysqli_fetch_Array($queryex);
	$kodee = substr($queryex['kdskrng'], 1) ;
	$kodee = $kodee + 1;
	$kodee = 'K'.$kodee;
	$query5  = "INSERT INTO kriteria values('$kodee','$nama2')";
	$query5 = mysqli_query($link, $query5);

	if($query5){
		$_SESSION['pesan'] = 'berhasil';
		echo '<script>window.location="?module=kriteria"</script>';
	}
	
}

if ($_POST['ubahinduk']){
	$nama2 = $_POST['nama2'];
	$kode_kriteria2 = $_POST['kode_kriteria2'];

	$query5 = "UPDATE kriteria set nama2='$nama2' WHERE kode_kriteria2='$kode_kriteria2'";
	$query5 = mysqli_query($link, $query5);
	if($query5){
		$_SESSION['pesan'] = 'ubah';
		echo '<script>window.location="?module=kriteria"</script>';
	}
	

}

if ($_POST['hapusinduk']){
	$kode_kriteria2 = $_POST['id'];
	
	$query4 = "DELETE FROM kriteria WHERE kode_kriteria2='$kode_kriteria2'";
	$query4 = mysqli_query($link, $query4);

	if ($query4) {

		$_SESSION['pesan'] = 'hapus';
		echo '<script>window.location="?module=kriteria"</script>';

	}


}

$query1 = "SELECT * FROM kriteria";
$hasil1 = mysqli_query($link, $query1);

$query2 ="SELECT kriteria.kode_kriteria2, kriteria.nama2, subkriteria.Nama, subkriteria.id_kriteria, subkriteria.bobot, subkriteria.kode_kriteria from subkriteria INNER JOIN kriteria ON subkriteria.kode_induk=kriteria.kode_kriteria2";
$hasil2 = mysqli_query($link, $query2);
$jumlahkriteria = mysqli_num_rows($hasil2);



?>

<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					KRITERIA INDUK
				</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">                                 
						<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#tambahinduk">TAMBAH KRITERIA INDUK</button>

					</li>
				</ul>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>Nomor</th>
								<th>Kriteria Induk</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nomor</th>
								<th>Kriteria Induk</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
						<?php
						$no = 0;
						while ($data1 = mysqli_fetch_Array($hasil1)) { 
							$no = $no +1;
							?>
								<tr>
									<td><?= $no; ?></td>
									<td><?= $data1['nama2']; ?></td>
									<td>
										<div  class="js-sweetalert">
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#hapuskriteria2<?= $data1['kode_kriteria2']; ?>">Hapus</button>
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#editkriteria2<?= $data1['kode_kriteria2']; ?>">Edit</button> 

										</div></td>
									</tr>
									
					<div class="modal fade" id="editkriteria2<?= $data1['kode_kriteria2']; ?>" tabindex="-1" role="dialog">
									
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="defaultModalLabel">Ubah Data Kriteria Induk</h4>
												</div>
												<div class="modal-body">
													<!-- Vertical Layout -->
													<div class="row clearfix">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<div class="card">
																<div class="body">
																	<form method="POST" enctype="multipart/form-data">
																		<label for="email_address">Nama</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="nama2" class="form-control" value="<?= $data1['nama2']; ?>">
																			</div>
																		</div>
																		

																		<input type="hidden" name="kode_kriteria2" value="<?= $data1['kode_kriteria2']; ?>">

																	</div>
																</div>
															</div>
														</div>
														<!-- #END# Vertical Layout -->
													</div>
													<div class="modal-footer">
														<input type="submit" required="" name="ubahinduk" value="Ubah Kriteria Induk" class="btn btn-link waves-effect" >
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
													</div>

												</form>
											</div>
										</div>
									</div>			
								

					<div class="modal fade" id="hapuskriteria2<?= $data1['kode_kriteria2']; ?>" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="defaultModalLabel">Hapus Kriteria Induk</h4>
												</div>
												<div class="modal-body">
													<h5> Apa Kamu Yakin Ingin Menghapus ??</h5>
													
													</div>
													<form method="POST">
													<div class="modal-footer">
														<input type="hidden" name="id" value="<?= $data1['kode_kriteria2']; ?>">
														<input type="submit" required="" name="hapusinduk" value="HAPUS" class="btn btn-link waves-effect" >
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
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
	<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					DAFTAR KRITERIA
				</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">                                 
						<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#tambahkriteria">TAMBAH KRITERIA</button>

					</li>
				</ul>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>Kriteria</th>
								<th>Kriteria Induk</th>
								<th>Bobot</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Kriteria</th>
								<th>Kriteria Induk</th>
								<th>Bobot</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php
							$no = 0;
							while ($data2 = mysqli_fetch_Array($hasil2)) {
								$no = $no +1; ?>
							
								<tr>
									<td><?= $data2['Nama']; ?></td>
									<td><?= $data2['nama2']; ?></td>
									<td><?= $data2['bobot']; ?></td>
									<td>
										<div  class="js-sweetalert">
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#hapusKRITERIA<?= $data2['id_kriteria']; ?>">Hapus</button>
											<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#editkriteria" data-id="<?=$data2['id_kriteria']; ?>">Edit</button> 

										</div></td>
									</tr>
								
					<div class="modal fade" id="hapusKRITERIA<?= $data2['id_kriteria']; ?>" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="defaultModalLabel">Hapus Kriteria  </h4>
												</div>
												<div class="modal-body">
													<h5> Apa Kamu Yakin Ingin Menghapus ??</h5>
													
													</div>
													<form method="POST">
													<div class="modal-footer">
														<input type="hidden" name="id" value="<?= $data2['id_kriteria']; ?>">
														<input type="submit" required="" name="hapus" value="HAPUS" class="btn btn-link waves-effect" >
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
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
	<div class="modal fade" id="tambahinduk" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Tambah Kriteria Induk</h4>
				</div>
				<div class="modal-body">
					<!-- Vertical Layout -->
					<div class="row clearfix">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="card">
								<div class="body">
									<form method="POST" >
										<label for="email_address">Nama Kriteria Induk</label>
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="nama2" class="form-control" placeholder="Masukkan Nama Kriteria Induk Baru">
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- #END# Vertical Layout -->
					</div>
					<div class="modal-footer">
						<input type="submit" required="" name="submitinduk" value="Tambah Kriteria Induk" class="btn btn-link waves-effect" >
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Default Size -->
	<div class="modal fade" id="tambahkriteria" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Tambah Kriteria</h4>
				</div>
				<div class="modal-body">
					<!-- Vertical Layout -->
					<div class="row clearfix">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="card">
								<div class="body">
									<form method="POST" >
										<label for="email_address">Nama Kriteria</label>
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Kriteria">
											</div>
										</div>
										<label for="password">Bobot Kepentingan</label>
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="bobot" class="form-control" placeholder="Masukkan Angka Bobot Kepentingan">
											</div>
										</div>
										<label for="password">Subkriteria dari</label>
										<div class="form-group">
											<div class="form-line">
												<select name="induk" >
												<?php
												$query1 = "SELECT * FROM kriteria";
												$hasil1 = mysqli_query($link, $query1);
												while ($data3 = mysqli_fetch_Array($hasil1)) { ?>
													<option value="<?= $data3['kode_kriteria2']; ?>"><?= $data3['nama2']; ?></option>
													<?php }	?>
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
						<input type="submit" required="" name="submit" value="Tambah Kriteria" class="btn btn-link waves-effect" >
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editkriteria" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Ubah Kriteria</h4>
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
							<!-- #END# Vertical Layout -->
						</div>
						<div class="modal-footer">
							
							<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
						</div>
					
				</div>
			</div>
		</div>

	<script src="plugins/jquery/jquery.min.js"></script>
	 <script type="text/javascript">

    $(document).ready(function(){
        $('#editkriteria').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            
            $.ajax({
                type : 'post',
                url : 'admin/ubahkriteria.php',
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

