<?php
$query7 = "SELECT * FROM pegawai WHERE status='aktif'";
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
															$query7 = "SELECT * FROM pegawai WHERE status='aktif'";
															$hasil7 = mysqli_query($link, $query7);
															while ($data2 = mysqli_fetch_array($hasil7)) {
                                                                $id_pegawai = $data2['id_pegawai'];
																?> 

																<tr>
																	<th scope="row" ><button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-id="<?= $data2['id_pegawai']; ?>" data-target="#detailpegawai"><?= $data2['nama']; ?></th>
                                                                    <?php
                                                                    $krit = $link->query("SELECT * FROM subkriteria");
                                                                    while($kriteria = mysqli_fetch_array($krit)){
                                                                        $id_krit = $kriteria['id_kriteria'];

                                                                        $select = $link->query("SELECT * FROM nilai_pegawai where id_pegawai='$id_pegawai' AND id_history='$id_history' AND id_penilai='$id_penilai' AND id_subk='$id_krit'");
                                                                        $tampil = mysqli_fetch_array($select);
                                                                        echo '<th>'.$tampil['nilai'].'</th>';
                                                                    } ?>
                                                                   
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
                                                            $hasil7 = $link->query("SELECT * FROM pegawai WHERE status='aktif'");
															while ($data2 = mysqli_fetch_array($hasil7)) {
                                                                $id_pegawai = $data2['id_pegawai'];
																?> 

																<tr>
																	<th scope="row" ><button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-id="<?= $data2['id_pegawai']; ?>" data-target="#detailpegawai"><?= $data2['nama']; ?></th>
                                                                    <?php
                                                                    $krit = $link->query("SELECT * FROM subkriteria");
                                                                    $total = 0;
                                                                    while($kriteria = mysqli_fetch_array($krit)){
                                                                        $id_krit = $kriteria['id_kriteria'];

                                                                        $select = $link->query("SELECT * FROM nilai_pegawai where id_pegawai='$id_pegawai' AND id_history='$id_history' AND id_penilai='$id_penilai' AND id_subk='$id_krit'");
                                                                        $tampil = mysqli_fetch_array($select);
                                                                        $total = pow($tampil['nilai'], $kriteria['bobot']) + $total;
                                                                        echo '<th>'.pow($tampil['nilai'], $kriteria['bobot']).'</th>';
																	}
                                                                        echo '<th>'.$total.'</th>';
                                                                    ?>
                                                                </tr>
                                                                    
                                                                <?php 
                                                                   
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
																	$hasil7 = $link->query("SELECT * FROM pegawai WHERE status='aktif'");
																	while ($data2 = mysqli_fetch_array($hasil7)) {
																		$avg = 0;
                                                               		$id_pegawai = $data2['id_pegawai'];
																?> 
																		<tr>
																			<th scope="row" ><button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-id="<?= $data2['id_pegawai']; ?>" data-target="#detailpegawai"><?= $data2['nama']; ?></th>
																		<?php
																			$query8 = "SELECT * FROM `penilai` WHERE id_user !=1 ";
																			$hasil8 = mysqli_query($link,$query8);
																			while($penilai = mysqli_fetch_array($hasil8)){
																				$id_penilai = $penilai['id_penilai'];
																				$hsl = hasilpenilai($id_pegawai, $id_penilai, $id_history);
																				$avg = $avg + $hsl;
																				echo '<th>'.$hsl.'</th>';
																			}
																			$ratarata = round($avg/$jumlahpenilai, 2);
																			echo '<th>'.$ratarata.'</th>';
																		  
																			insert($id_pegawai, $ratarata, $id_history);
																		?>
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
										function hasilpenilai($pegawai, $penilai, $history){
											include'koneksi.php';
											$query6 = $link->query("SELECT * FROM nilai_pegawai where id_pegawai='$pegawai' AND id_history='$history' AND id_penilai='$penilai'");
											$hasil = 0;
											while($hasil6 = mysqli_fetch_array($query6)){
												$id_krit = $hasil6['id_subk'];
												$nilai = $hasil6['nilai'];
												$kriteria = $link->query("SELECT * FROM subkriteria WHERE id_kriteria='$id_krit'");
												$kriteria = mysqli_fetch_array($kriteria);
												$bobot = $kriteria['bobot'];

												$HASIL = pow($nilai, $bobot);
												$hasil = $hasil + $HASIL;
											};
											
											return $hasil;
										}

										function insert($id_pegawai, $hasill, $history){
											include 'koneksi.php';
											$query = "SELECT * FROM hasil where id_pegawai='$id_pegawai' AND id_history='$history'";
											$link2= mysqli_query($link, $query);
											$data = mysqli_fetch_array($link2);

											if (isset($data)) {

												$query2 = "UPDATE hasil set hasil='$hasill' where id_pegawai='$id_pegawai' AND id_history='$history'";
												$link2  = mysqli_query($link, $query2); 
											}
											else {

												$query2 = "INSERT INTO `hasil`(`id_hasil`, `id_pegawai`, `id_history`, `hasil`) VALUES ('','$id_pegawai','$history','$hasill')";
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

