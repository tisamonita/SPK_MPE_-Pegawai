<?php

$id_nilai = $_GET['kd'];
$query1 = "SELECT pegawai.nip, pegawai.foto, pegawai.nama, nilai_pegawai.C1, nilai_pegawai.C2, nilai_pegawai.C3, nilai_pegawai.C4, nilai_pegawai.C5, nilai_pegawai.C6 , nilai_pegawai.C7, nilai_pegawai.C8, nilai_pegawai.C9, nilai_pegawai.C10, nilai_pegawai.C11, nilai_pegawai.C12, nilai_pegawai.C13 , nilai_pegawai.C14, nilai_pegawai.C15, nilai_pegawai.C16 from nilai_pegawai inner join pegawai on pegawai.id_pegawai=nilai_pegawai.id_pegawai where id_nilai='$id_nilai'";
$hasil1 = mysqli_query($link, $query1);
$data1 = mysqli_Fetch_Array($hasil1);

$query2 ="SELECT kriteria.kode_kriteria, kriteria.nama2, subkriteria.Nama from subkriteria INNER JOIN kriteria ON subkriteria.kode_induk=kriteria.kode_kriteria";
$hasil2 = mysqli_query($link, $query2);

$nip = $data1['nip'];
$query3 ="SELECT * FROM pegawai where nip='$nip'";
$hasil3 = mysqli_query($link, $query3);
$pegawai = mysqli_fetch_array($hasil3);

if ($_POST['ubahnilai']){
	$C1 = $_POST['C1'];
	$C2 = $_POST['C2'];
	$C3 = $_POST['C3'];
	$C4 = $_POST['C4'];
	$C5 = $_POST['C5'];
	$C6 = $_POST['C6'];
	$C7 = $_POST['C7'];
	$C8 = $_POST['C8'];
	$C9 = $_POST['C9'];
	$C10 = $_POST['C10'];
	$C11 = $_POST['C11'];
	$C12 = $_POST['C12'];
	$C13 = $_POST['C13'];
	$C14 = $_POST['C14'];
	$C15 = $_POST['C15'];
	$C16 = $_POST['C16'];

	$query4 = "UPDATE nilai_pegawai SET C1='$C1', C2='$C2', C3='$C3', C4='$C4', C5='$C5', C6='$C6', C7='$C7', C8='$C8', C9='$C9', C10='$C10', C11='$C11', C12='$C12', C13='$C13', C14='$C14', C15='$C15', C16='$C16' WHERE id_nilai='$id_nilai'";
	$hasil4 = mysqli_query($link, $query4);

	if($hasil4){
		$_SESSION['pesan'] = 'ubah';
		echo '<script>window.location="?module=isian&kd='.$id_nilai.'"</script>';
	}




}

?>

<!-- Select -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					Nilai Pegawai
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

				<div class="list-group">
					<div class="row clearfix">
						<div class="col-sm-2">
							<p class="list-group-item">
								<a href="<?= $pegawai['foto']; ?>" target="_blank"> <img src="<?= $pegawai['foto']; ?>" width="100px" ?> </a>
							</p>
						</div>
						<div class="col-sm-10">
							<div class="col-sm-2">
								<p class="list-group-item">
									Nama
								</p>
							</div>
							<div class="col-sm-10">
								<a href="javascript:void(0);" class="list-group-item">
									<?php echo $pegawai['nama']; ?>
								</a>
							</div>
							<div class="col-sm-2">
								<p class="list-group-item">
									NIP
								</p>
							</div>
							<div class="col-sm-10">
								<a href="javascript:void(0);" class="list-group-item">
									<?php echo $pegawai['nip']; ?>
								</a>
							</div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#detailPEGAWAI<?php echo $pegawai['nip']; ?>">Detail</button>
							</div>
						</div>
					</div>
				</div>
				<form method="POST">
				<?php
				$id = 0;
				$K = 0;
				while( $kriteria = mysqli_fetch_array($hasil2)){
					$K = $K + 1;
					$C = 'C'.$K;


				 ?>
				<h2 class="card-inside-title">
				<span style="color:red">
				<?php
				$echo1x = 'K'.$echo1;
				if($kriteria['kode_kriteria']==$echo1x){
					echo "";
				}
				else {
					echo $kriteria['nama2'].'<br>';
					$echo1 = $echo1 + 1;
				}
				

				?>
				 </span>
				<?=$K.' '.$kriteria['Nama'];  ?></h2>
				<div class="demo-radio-button">
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="1" <?php if($data1[$C]==1){ echo "checked"; } ?>   type="radio" class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Kurang Sekali</label>
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="2" <?php if($data1[$C]==2){ echo "checked"; } ?> type="radio" class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Kurang</label>
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="3" <?php if($data1[$C]==3){ echo "checked"; } ?> type="radio" class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Cukup</label>
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="4" <?php if($data1[$C]==4){ echo 'checked'; } ?> type="radio" class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Baik</label>
					<?php $id = $id+1; ?>
					<input name="C<?=$K; ?>" value="5" selected type="radio" <?php if($data1[$C]==5){ echo 'checked'; } ?> class="with-gap" id="radio_<?=$id; ?>" />
					<label for="radio_<?=$id; ?>">Baik Sekali</label>
				</div>
				<?php } ?>
				<br>
				<input type="submit" name="ubahnilai" class="btn bg-green waves-effect m-r-20" value="Input Nilai">
				</form>

			</div>

		</div>
	</div>
</div>
<!-- #END# Select -->

<div class="modal fade" id="detailPEGAWAI<?php echo $pegawai['nip']; ?>" tabindex="-1" role="dialog">
	<?php
	$nip = $pegawai['nip']; 
	$query5 = "SELECT * FROM pegawai WHERE nip='$nip'";
	$hasil5 = mysqli_query($link, $query5);
	$hasil5 = mysqli_fetch_array($hasil5);



	?>
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
								<form method="POST" >
									<label for="email_address">Nama</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['nama']; ?>">
										</div>
									</div>

									<label for="email_address">NIP</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['nip']; ?>">
										</div>
									</div>																		<input type="hidden" name="id_user" value="<?= $id_user; ?>" >


									<label for="jabatan">Bagian</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="nama" class="form-control" disabled value="<?= $hasil5['bagian']; ?>">
										</div>
									</div>

									<label for="password">Pendidikan</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="username" class="form-control" disabled value="<?= $hasil5['pendidikan']; ?>">
										</div>
									</div>
									<label for="password">Tanggal Terima</label>
									<div class="form-group">
										<div class="form-line disabled">
											<input type="text" name="username" class="form-control" disabled value="<?= $hasil5['tgl_terima']; ?>">
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
					<button ty pe="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
				</div>

			</form>
		</div>
	</div>
</div>