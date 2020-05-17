<?php
if($_SESSION['pesan']){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php 

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

$query2 = "SELECT * FROM hasil ORDER by hasil desc";
$hasil2 = mysqli_query($link,$query2);
$jumlah = mysqli_num_rows($hasil2);



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
									<td> <?= $datax['keputusan']; ?> </td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		

		<script src="js/pages/ui/modals.js"></script>
		<script src="js/pages/ui/dialogs.js"></script>
		<script src="plugins/sweetalert/sweetalert.min.js"></script>
		<script src="js/pages/forms/advanced-form-elements.js"></script>

