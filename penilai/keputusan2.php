<?php
include '../koneksi.php';
if($_POST['rowid']){

	$id_pegawai = $_POST['rowid'];

	$query3 = "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'";
	$hasil3 = mysqli_query($link,$query3);
	$hasil3 = mysqli_fetch_array($hasil3);
	?>
	    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
	<form method="POST">

		<label for="email_address">Nama</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input disabled type="text" name="nama" value="<?= $hasil3['nama']; ?>" class="form-control" >
			</div>
		</div>
		<label for="email_address">Tanggal SK Pertama</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input type="text" disabled name="nip" value="<?= $hasil3['tgl_skpertama']; ?>" class="form-control" >
			</div>
		</div>

		<input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>" >

		<label for="password">Keputusan</label>
		<div class="form-group">
			<div class="form-line">
				<select name="keputusan">
					<option value="peringatan">Diberikan Surat Peringatan</option>
					<option value="berhentikan">Kontrak kerja tidak dilanjutkan</option>
					<option value="">Batalkan</option>
				</select>
			</div>
		</div>
		<br>
		<input type="submit" required="" name="submit" value="Buat Keputusan" class="btn btn-primary waves-effect" >
	</div>
	</form>



	<?php }

	?>

		<script src="../js/pages/ui/modals.js"></script>
		<script src="../js/pages/ui/dialogs.js"></script>
		<script src="../plugins/sweetalert/sweetalert.min.js"></script>
		<script src="../js/pages/forms/advanced-form-elements.js"></script>