<?php 


	$id_history= $_GET['kd'];

	$query3 = $link-> query("SELECT * FROM history WHERE id_history='$id_history'");
    $hasil5 = mysqli_fetch_array($query3);
    
	$queryH = $link->query("SELECT * FROM hasil WHERE id_history='$id_history' ORDER by hasil desc");

?>

<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					Detail History HASIL PENILAIAN
				</h2>
			</div>
			<div class="body"> 
				<h4> Tanggal Keputusan : <?= $hasil5['tanggal']; ?></h4>

				<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th> Peringkat </th>
								<th> Foto </th>
								<th>Nama</th>
								<th>Tanggal SK</th>
								<th> Nilai </th>
								<th> Keputusan </th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th> Peringkat </th>
								<th> Foto </th>
								<th>Nama</th>
								<th>Tanggal SK</th>
								<th> Nilai </th>
								<th> Keputusan </th>
							</tr>
						</tfoot>
						<tbody>
									<?php 
							$pkt = 0; 
							while ($datax = mysqli_fetch_Array($queryH)) {
								$pkt = $pkt + 1;
								$id_pegawai =$datax['id_pegawai'];
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
