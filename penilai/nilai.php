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

$query1 = "SELECT * from pegawai ORDER BY nama ASC";
$hasil1 = mysqli_query($link, $query1);



?>
<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					NILAI PEGAWAI TIDAK TETAP
				</h2>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th> Foto </th>
								<th>Nama</th>
								<th>Bagian/Bidang</th>
								<th> Pendidikan </th>
								<th> Tanggal SK Pertama </th>
								<th>Nilai</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th> Foto </th>
								<th>Nama</th>
								<th>Bagian/Bidang</th>
								<th> Pendidikan </th>
								<th> Tanggal SK Pertama </th>
								<th>Nilai</th>
							</tr>
						</tfoot>
						<tbody>
							<?php while($data= mysqli_Fetch_Array($hasil1)){
								$id_pegawai = $data['id_pegawai'];
								$querynilai = "SELECT * FROM nilai_pegawai where id_pegawai='$id_pegawai' and id_penilai='$id_penilai' ";
								$hasilnilai = mysqli_query($link, $querynilai);
								$hasilnilai = mysqli_Fetch_Array($hasilnilai);


								?>
								<tr>
									<td><img src="<?=  $data['foto']; ?>" width="70px" </td>
									<td><?=  $data['nama']; ?> </td>
									<td><?=  $data['bagian']; ?></td>
									<td><?=  $data['pendidikan']; ?></td>
									<td><?=  $data['tgl_skpertama']; ?></td>
									<td>
										<div  class="js-sweetalert">
											<a href="?module=nilai_pegawai&kd=<?= $data['id_pegawai']; ?>">
												<?php 
												if (isset($hasilnilai)) { ?>
													<button type="button" class="btn btn-primary waves-effect"> Lihat Nilai</button>
												<?php }
												else { ?>
													<button type="button" class="btn btn-warning waves-effect"> Nilai</button>
												
												<?php }
												?>
												
											</a>
										</div>
									</td>
								</tr>

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
									<form method="POST">
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
										<br>
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

