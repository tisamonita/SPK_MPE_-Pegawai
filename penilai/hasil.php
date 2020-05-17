<?php


if ($_SESSION['role_2']!='ketuapenilai'){
	header('location: index.php');  
} 

$query2 = "SELECT * FROM hasil ORDER by hasil desc";
$hasil2 = mysqli_query($link,$query2);
$jumlah = mysqli_num_rows($hasil2);
$warning = $jumlah - 1;
$warning2 = $warning - 1;

if($_POST['submit']){
	$hasil = $_POST['nama'];
	$keputusan = $_POST['keputusan'];
	$id_pegawai = $_POST['id_pegawai'];
	
		$query11 = "UPDATE hasil set keputusan='$keputusan' WHERE id_pegawai='$id_pegawai'";
		$hasil11 = mysqli_query($link, $query11);
	if ($hasil11) {
			$_SESSION['pesan'] = 'berhasil';
			echo '<script>window.location="?module=keputusan3"</script>';
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
								<th> Nilai </th>
								<th> Keputusan </th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th> Peringkat </th>
								<th> Foto </th>
								<th>Nama</th>
								<th> Nilai </th>
								<th> Keputusan </th>
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
									<td><?= $datax['hasil']; ?></td>
									<td> <?php

								
									if ($datax['keputusan']=='peringatan') {
									 	echo "Diberikan Surat Peringatan";
									 } 

									 if ($datax['keputusan']=='berhentikan') {
									 	echo "Kontrak kerja tidak dilanjutkan";
									 } 
									 if ($datax['keputusan']=='lanjut') {
									 	echo "Kontrak kerja dilanjutkan";
									 } 
									  ?> </td>
									
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

