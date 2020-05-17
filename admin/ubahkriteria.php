<?php
include '../koneksi.php';



if($_POST['rowid']){

	$id_kriteria = $_POST['rowid'];

	$query2 ="SELECT kriteria.kode_kriteria2, kriteria.nama2, subkriteria.Nama, subkriteria.id_kriteria, subkriteria.bobot, subkriteria.kode_kriteria from subkriteria INNER JOIN kriteria ON subkriteria.kode_induk=kriteria.kode_kriteria2 WHERE subkriteria.id_kriteria='$id_kriteria'";
	$hasil2 = mysqli_query($link, $query2);
	$hasil2 = mysqli_fetch_array($hasil2);
	?>
	<!-- Bootstrap Select Css -->
	<link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
	<form method="POST">

		<label for="email_address">Nama Kriteria</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input type="text" name="nama" value="<?= $hasil2['Nama']; ?>" class="form-control" >
			</div>
		</div>
		<label for="email_address">Bobot</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input type="text" name="bobot" value="<?= $hasil2['bobot']; ?>" class="form-control" >
			</div>
		</div>

		<input type="hidden" name="id_kriteria" value="<?= $id_kriteria; ?>" >

		<label for="password">Kriteria Induk</label>
		<div class="form-group">
			<div class="form-line">
				<select name="induk" >
					<?php
					$query1 = "SELECT * FROM kriteria";
					$hasil1 = mysqli_query($link, $query1);
					while ($data3 = mysqli_fetch_Array($hasil1)) { ?>
						<option value="<?= $data3['kode_kriteria2']; ?>"><?= $data3['nama2']; ?></option>
						<?php }	?>
					</select>
				</div>
			</div>
			<br>
			<input type="submit" required="" name="ubah" value="Ubah Kriteria" class="btn btn-primary waves-effect" >
		</div>
	</form>



	<?php }

	?>

	<script src="../js/pages/ui/modals.js"></script>
	<script src="../js/pages/ui/dialogs.js"></script>
	<script src="../plugins/sweetalert/sweetalert.min.js"></script>
	<script src="../js/pages/forms/advanced-form-elements.js"></script>