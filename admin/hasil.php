<?php
$query7 = "SELECT * FROM pegawai";
$hasil7 = mysqli_query($link, $query7);

$query8 = "SELECT * FROM `penilai` WHERE id_user !=1 ";
$hasil8 = mysqli_query($link,$query8);
$jumlahpenilai = mysqli_num_rows($hasil8);


?>


<!-- Example Tab -->
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					REKAP HASIL PENILAIAN
					<small>Berikut merupakan rekap hasil penilaian dari Tim penilai</small>
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
				<!-- Nav tabs -->
				<ul class="nav nav-tabs tab-nav-right" role="tablist">
					<?php 
					for($i = 1; $i <=$jumlahpenilai; $i++) { ?>
						<li role="presentation"><a href="#penilai<?=$i; ?>" data-toggle="tab">Penilai <?= $i; ?></a></li>
						<?php }
						?>

						<li role="presentation"  class="active" ><a href="#rekap" data-toggle="tab">Rekap</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<?php
						$i = 0;
						while ($data8 = mysqli_fetch_array($hasil8)) {
							$i = $i +1;
							$id_penilai = $data8['id_penilai'];
							?>
							<div role="tabpanel" class="tab-pane fade" id="penilai<?=$i; ?>">
								<!-- Striped Rows -->
								<div class="row clearfix">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="card">
											<div class="header">
												<h2>
													Penilai <?= $i; ?>
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
												<table class="table table-striped">
													<thead>
														<tr>
															<th scope="row">NAMA</th>
															<?php 
															$query10 = "SELECT * FROM subkriteria";
															$hasil10 = mysqli_query($link,  $query10);
															$jumlahkriteria = mysqli_num_rows($hasil10);
															for($x = 1; $x<=$jumlahkriteria; $x++){


																?>
																<th>C<?=$x; ?></th>
																<?php } ?>

															</tr>
														</thead>
														<tbody>
															<?php
															$query2 = "SELECT * from nilai_pegawai where id_penilai='$id_penilai'";
															$hasil2 = mysqli_query($link, $query2);

															while ($data2 = mysqli_fetch_array($hasil2)) {
																$id_pegawai = $data2['id_pegawai'];

																$query3 = "SELECT * from pegawai where id_pegawai='$id_pegawai'";
																$hasil3 = mysqli_query($link, $query3);	
																$pegawai = mysqli_fetch_array($hasil3);
																?> 

																<tr>
																	<th scope="row" ><button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-id="<?= $pegawai['id_pegawai']; ?>" data-target="#detailpegawai"><?= $pegawai['nama']; ?></th>
																	<?php for($x = 1; $x<=$jumlahkriteria; $x++){
																		$C = 'C'.$x;
																		?>
																	<th><?= $data2[$C]; ?></th>
																	<?php } ?>

																</tr>

																<?php } ?>

															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<!-- #END# Striped Rows -->
										<!-- Striped Rows -->
										<div class="row clearfix">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="card">
													<div class="header">
														<h2>
															Total Nilai
															<small>Nilai dipangkatkan dengan bobot kepentingan kriteria</small>
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
														<table class="table table-striped">
															<thead>
																<tr>
																	<th scope="row">Nama</th>
																	<?php 
															$query10 = "SELECT * FROM subkriteria";
															$hasil10 = mysqli_query($link,  $query10);
															$jumlahkriteria = mysqli_num_rows($hasil10);
															for($x = 1; $x<=$jumlahkriteria; $x++){


																?>
																<th>C<?=$x; ?></th>
																<?php } ?>
																	<th> Hasil </th>
																</tr>
															</thead>
															<tbody>
																<?php
																$query2 = "SELECT * from nilai_pegawai where id_penilai='$i'";
																$hasil2 = mysqli_query($link, $query2);

																while ($data2 = mysqli_fetch_array($hasil2)) {
																	$id_pegawai = $data2['id_pegawai'];
																	$id_nilai = $data2['id_nilai'];

																	$query3 = "SELECT * from pegawai where id_pegawai='$id_pegawai'";
																	$hasil3 = mysqli_query($link, $query3);	
																	$pegawai = mysqli_fetch_array($hasil3);
																	?> 

																	<tr>
																		<th scope="row" >
																			<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-id="<?= $pegawai['id_pegawai']; ?>" data-target="#detailpegawai"><?= $pegawai['nama']; ?>
																			</th>
																			<?php
																			$query4 = "SELECT * FROM subkriteria";
																			$hasil4 = mysqli_query($link, $query4);
																			$C =0;
																			$total = 0;

																			while($kriteria = mysqli_fetch_array($hasil4)){

																				$C = $C + 1;
																				$K = $kriteria['kode_kriteria'];
																				$total = pow($data2[$K], $kriteria['bobot']) + $total;
																				echo '<td>'.pow($data2[$K], $kriteria['bobot']).'</td>';
																			}

																			?>

																			<th> <?= $total ;?> </th>
																		</tr>

																		<?php 
																		$query5 = "UPDATE nilai_pegawai set hasil='$total' where id_nilai='$id_nilai'";
																		$hasil5 = mysqli_query($link, $query5);
																	} ?>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<!-- #END# Striped Rows -->
										</div>
										<?php } ?>
										<div role="tabpanel" class="tab-pane fade in active" id="rekap">
											<!-- Striped Rows -->
											<div class="row clearfix">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="card">
														<div class="header">
															<h2>
																Rekap Hasil Akhir
																<small>Nilai rata-rata dari tiap penilai</small>
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
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th scope="row" >Nama</th>
																		<?php for($i = 1; $i <=$jumlahpenilai; $i++) { ?>
																			<th>Penilai <?= $i; ?></th>
																			<?php } ?>
																			<th> Rata - rata </th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 

																		while ($data7 = mysqli_fetch_array($hasil7)) {
																			$avg = 0;
																			$id_pegawai = $data7['id_pegawai'];
																			$query3 = "SELECT * from pegawai where id_pegawai='$id_pegawai'";
																			$hasil3 = mysqli_query($link, $query3);	
																			$pegawai = mysqli_fetch_array($hasil3);
																			?>
																			<tr>
																				<th scope="row">
																					<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-id="<?= $pegawai['id_pegawai']; ?>" data-target="#detailpegawai"><?= $pegawai['nama']; ?>
																					</th>
																					<?php
																					$query9 = "SELECT * FROM penilai WHERE id_user != 1";
																					$hasil9 = mysqli_query($link,$query9);
																					while($datax = mysqli_fetch_array($hasil9)) { 
																						echo '<th>';
																						$id_penilai = $datax['id_penilai'];
																						$hsil =  hasilpenilai($id_pegawai, $id_penilai);
																						echo $hsil;
																						$avg = $avg + $hsil;
																						echo '</th>';

																					} ?>

																					<th> 

																						<?php $hasill =  round($avg/$jumlahpenilai, 2);
																						echo $hasill;
																						insert($id_pegawai, $hasill);
																						?>
																					</th>
																				</tr>
																				<?php } ?>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
														<!-- #END# Striped Rows -->
													</div>
												</div>
											</div>
										</div>

										<?php
										function hasilpenilai($pegawai, $penilai){
											include'koneksi.php';
											$query6 = "SELECT * FROM nilai_pegawai where id_pegawai='$pegawai' AND id_penilai='$penilai'";
											$hasil6 = mysqli_query($link, $query6);
											$hasil6 = mysqli_fetch_array($hasil6);
											$hasil = $hasil6['hasil'];
											return $hasil;
										}

										function insert($id_pegawai, $hasill){
											include 'koneksi.php';
											$query = "SELECT * FROM hasil where id_pegawai='$id_pegawai'";
											$link2= mysqli_query($link, $query);
											$data = mysqli_fetch_array($link2);

											if (isset($data)) {

												$query2 = "UPDATE hasil set hasil='$hasill' where id_pegawai='$id_pegawai'";
												$link2  = mysqli_query($link, $query2); 
											}
											else {

												$query2 = "INSERT INTO `hasil`(`id_hasil`, `id_pegawai`, `hasil`) VALUES ('','$id_pegawai','$hasill')";
												$link2 = mysqli_query($link, $query2);
											}

										}

										?>			

										<div class="modal fade" id="detailpegawai" tabindex="-1" role="dialog">
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
													$('#detailpegawai').on('show.bs.modal', function (e) {
														var rowid = $(e.relatedTarget).data('id');

														$.ajax({
															type : 'post',
															url : 'admin/detailpegawai.php',
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

