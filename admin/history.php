<?php
if($_SESSION['pesan']){ ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php if($_SESSION['pesan'] =='berhasil') {
            echo "KEPUTUSAN TELAH SELESAI DIPROSES";

        } 
        if($_SESSION['pesan'] =='ubah'){
            echo "Data Admin Berhasil Diubah";
        }

        ?>
        
    </div>

    <?php 
    unset($_SESSION['pesan']);
}

$query1 = "SELECT * FROM history WHERE status='selesai' ORDER BY tanggal DESC";
$query1 = mysqli_query($link, $query1);
?>


<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					RIWAYAT HASIL PENILAIAN
				</h2>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal Keputusan</th>
								<th>Download</th>
								<th> Lihat </th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Tanggal Keputusan</th>
								<th>Download</th>
								<th>Lihat </th>
							</tr>
						</tfoot>
						<tbody>
							<?php $i =0;
							 while ($data = mysqli_fetch_array($query1)) {
							$i = $i +1;
							 ?>
							<tr>
								<th><?= $i; ?></th>
								<th><?= $data['tanggal']; ?></th>
								<th> <a href="<?=$data['file']; ?>" target="_blank" > <button type="button" class="btn btn-primary waves-effect" >Download File</button> </a> </th>
								<th> <a href="?module=detailhistory&kd=<?=$data['id_history'];?>" > <button type="button" class="btn btn-success waves-effect" >Lihat File</button> </a> </th>
							</tr>

							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
