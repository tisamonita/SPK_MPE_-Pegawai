<?php
if($_SESSION['pesan']){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php if($_SESSION['pesan'] =='berhasil') {
			echo "Keputusan Berhasil dibuat";

		} 
		if($_SESSION['pesan'] =='ubah'){
			echo "Keputusan Berhasil Diubah";
		}

		if($_SESSION['pesan'] =='selesai'){
			echo "Keputusan Telah Selesai Dikonfirmasi";
		}
		?>
	</div>
	<?php 
	unset($_SESSION['pesan']);
}

if ($_SESSION['role']!='ketua'){
	header('location: index.php');  
} 

$querycek = "SELECT * FROM history WHERE status='belum'";
$querycek = mysqli_query($link, $querycek);
$jumlahcek = mysqli_num_rows($querycek);
if($jumlahcek==0){
	echo '<script>window.location="?module=keputusanselesai"</script>';
}


$cekkep = $link -> query("SELECT * FROM penilai WHERE id_user <> 1");
while($dtcek = mysqli_fetch_Array($cekkep)){
	$id_penilai = $dtcek['id_penilai'];
	$query2 = $link-> query("SELECT * from nilai_pegawai where id_penilai='$id_penilai'");
	$juml = mysqli_num_rows($query2);
	if($juml==0 || $juml<$jumlahp){
		echo '<script>window.location="?module=keputusan3"</script>';
	}
	
}

$query2 = "SELECT * FROM hasil ORDER by hasil desc";
$hasil2 = mysqli_query($link,$query2);
$jumlah = mysqli_num_rows($hasil2);
$warning = $jumlah - 1;
$warning2 = $warning - 1;

if($_POST['submit']){
	$hasil = $_POST['nama'];
	$hasil2 = $_POST['nip'];
	$keputusan = $_POST['keputusan'];
	$id_pegawai = $_POST['id_pegawai'];
	
	$query11 = "UPDATE hasil set keputusan='$keputusan' WHERE id_pegawai='$id_pegawai'";
	$hasil11 = mysqli_query($link, $query11);
	if ($hasil11) {
		$_SESSION['pesan'] = 'berhasil';
		echo '<script>window.location="?module=keputusan"</script>';
	}
	
}

if($_POST['selesai']){
	$tanggal = $_POST['tanggal'];
	$query11 = "UPDATE hasil set keputusan='lanjut' WHERE keputusan=''";
	$hasil11 = mysqli_query($link, $query11);
	$query12 = "UPDATE history set tanggal='$tanggal', status='konfirm' WHERE status='belum'";
	$query12 = mysqli_query($link, $query12);
	if ($query12) {
		$_SESSION['pesan'] = 'selesai';
		echo '<script>window.location="?module=keputusanselesai"</script>';
	}	
}
?>
<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					KEPUTUSAN
				</h2>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th> Peringkat </th>
								<th> Foto </th>
								<th>Nama</th>
								<th>Tanggal SK</th>
								<th> Nilai </th>
								<th> Status </th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th> Peringkat </th>
								<th> Foto </th>
								<th>Nama</th>
								<th>Tanggal SK</th>
								<th> Nilai </th>
								<th> Status </th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php 
							$pkt = 0; 
							while ($datax = mysqli_fetch_Array($hasil2)) {
								$pkt = $pkt + 1;
								$id_pegawai =$datax['id_pegawai'];
								$queryupdate = $link->query("UPDATE hasil set peringkat='$pkt' WHERE id_pegawai='$id_pegawai'");
								$query3 = $link->query("SELECT * FROM pegawai where id_pegawai='$id_pegawai'");
								$dtpegawai = mysqli_fetch_Array($query3);
								
								?>
								<tr>
									<td> <?= $pkt; ?> </td>
									<td><a href="<?= $dtpegawai['foto']; ?>" target=_blank> <img src="<?= $dtpegawai['foto']; ?>" width="70px" > </a> </td>
									<td><?= $dtpegawai['nama']; ?></td>
									<td><?= $dtpegawai['tgl_skpertama']; ?></td>
									<td><?= $datax['hasil']; ?></td>
									<td> <?php

										if($datax['keputusan'] =='peringatan'){
											echo "Diberikan Surat Peringatan";
										} 

										if($datax['keputusan'] =='berhentikan'){
											echo "Kontrak kerja tidak dilanjutkan";
										} 
										?> </td>
										<td>
											<div  class="js-sweetalert">
												<?php if ($pkt < $warning2) { ?>
													<button type="button" class="btn btn-success waves-effect">Kontrak Kerja Dilanjutkan</button> 
													<?php } 
													if ($pkt >= $warning2 && $pkt <= $warning) { ?>
														<button type="button" class="btn btn-warning waves-effect" data-id="<?=$datax['id_pegawai']; ?>" data-toggle="modal" data-target="#keputusan">

															<?php if($datax['keputusan']== ""){
																echo "Diberikan Surat Peringatan";
															} 
															else {
																echo "Ubah Keputusan";
															}
															?> </button> 

															<?php }  
															if ($pkt >= $jumlah) { ?>
																<button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#keputusan" data-id="<?=$datax['id_pegawai']; ?>" >
																	<?php if($datax['keputusan']== ""){
																		echo "Kontrak kerja tidak dilanjutkan";
																	} 
																	else {
																		echo "Ubah Keputusan";
																	}
																	?> 
																</button> 

																<?php } ?>
															</div></td>
														</tr>
														<?php } ?>
													</tbody>
												</table>
												<button type="button" data-toggle="modal" data-target="#keputusan2" class="btn btn-block btn-primary waves-effect"> Keputusan Selesai </button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="modal fade" id="keputusan" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="defaultModalLabel">Buat Keputusan</h4>
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
							</div>

							<div class="modal fade" id="keputusan2" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="defaultModalLabel">Konfirmasi Keputusan Selesai</h4>
										</div>
										<div class="modal-body">
											<!-- Vertical Layout -->
											<div class="row clearfix">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="card">
														<div class="body">
															<h4>	Yakin Keputusan Telah Selesai ? </h4>
															<form class="form-horizontal" method="POST">
																<div class="row clearfix">
																	<div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
																		<label for="email_address_2">Tanggal Konfirmasi</label>
																	</div>
																	<div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
																		<div class="form-group">
																			<div class="form-line">
																				<input type="date" name="tanggal">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!-- #END# Vertical Layout -->
												</div>
												<div class="modal-footer">
													<input type="submit" name="selesai" class="btn btn-link waves-effect" value="YAKIN">
												</form>
												<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
											</div>

										</div>
									</div>
								</div>
								<script src="plugins/jquery/jquery.min.js"></script>
								<script type="text/javascript">

									$(document).ready(function(){
										$('#keputusan').on('show.bs.modal', function (e) {
											var rowid = $(e.relatedTarget).data('id');

											$.ajax({
												type : 'post',
												url : 'penilai/keputusan2.php',
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

