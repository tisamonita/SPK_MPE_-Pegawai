<?php
include '../koneksi.php';
if($_POST['rowid']){

	$nip = $_POST['rowid'];

	$query3 = "SELECT * FROM pegawai WHERE id_pegawai='$nip'";
	$hasil3 = mysqli_query($link,$query3);
	$hasil3 = mysqli_fetch_array($hasil3);
	?>

	<form method="POST" >
			<center> <img src="<?=$hasil3['foto'];?>" width="130px" > </center>  <br>
		<label for="email_address">Nama</label>
		<div class="form-group">
			<div class="form-line disabled">
			<input type="text" name="nama" class="form-control" disabled value="<?= $hasil3['nama']; ?>">
			</div>
		</div>

		<label for="email_address">Tanggal SK Pertama</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input type="text" name="nama" class="form-control" disabled value="<?= $hasil3['tgl_skpertama']; ?>">
			</div>
		</div>																		<input type="hidden" name="id_user" value="<?= $id_user; ?>" >


		<label for="jabatan">Bagian</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input type="text" name="nama" class="form-control" disabled value="<?= $hasil3['bagian']; ?>">
			</div>
		</div>

		<label for="password">Pendidikan</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input type="text" name="username" class="form-control" disabled value="<?= $hasil3['pendidikan']; ?>">
			</div>
		</div>
		<label for="password">Tanggal Lahir</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input type="text" name="username" class="form-control" disabled value="<?= $hasil3['tanggal_lahir']; ?>">
			</div>
		</div>
		<label for="password">Jenis Kelamin</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input type="text" name="username" class="form-control" disabled value="<?= $hasil3['jeniskelamin']; ?>">
			</div>
		</div>
		<label for="password">Alamat</label>
		<div class="form-group">
			<div class="form-line disabled">
				<input type="text" name="username" class="form-control" disabled value="<?= $hasil3['alamat']; ?>">
			</div>
		</div>
		<br>
	</div>	

	<?php } ?>