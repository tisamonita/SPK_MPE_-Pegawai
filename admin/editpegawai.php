<?php 

include '../koneksi.php';
	$id_pegawai = $_POST['rowid'];

	$query3 = "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'";
	$hasil3 = mysqli_query($link,$query3);
	$hasil5 = mysqli_fetch_array($hasil3);

?>


<form method="POST" enctype="multipart/form-data" action="?module=ubahpegawai">
	<label for="email_address">Nama</label>
	<div class="form-group">
		<div class="form-line">
			<input type="text" name="nama" value="<?= $hasil5['nama']; ?>" id="email_address" class="form-control" placeholder="Masukkan Nama Pegawai">
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
			<input type="text" value="<?= $hasil5['pendidikan']; ?>" name="pendidikan" class="form-control" >
		</div>
	</div>
	<label for="password">Tanggal SK Pertama</label>
	<div class="form-group">
		<div class="form-line">
			<input type="date" name="tanggal" value="<?= $hasil5['tgl_skpertama']; ?>" class="form-control" >
		</div>
	</div>
	<label for="password">Jenis Kelamin</label>
	<div class="form-group">
		<div class="form-line">
			<select name="jeniskelamin">
				<option value="Perempuan">Perempuan</option>
				<option value="Laki-laki">Laki-laki</option>
			</select>
		</div>
	</div>
	<input type="hidden" name="id_pegawai" value="<?= $hasil5['id_pegawai']; ?>">
	<label for="password">Alamat</label>
	<div class="form-group">
		<div class="form-line">
			<input type="text" name="alamat" value="<?= $hasil5['alamat']; ?>" class="form-control" placeholder="Masukkan Alamat Pegawai">
		</div>
	</div>
	<label for="password">Tanggal Lahir</label>
	<div class="form-group">
		<div class="form-line">
			<input type="date" name="tanggallahir" value="<?= $hasil5['tanggal_lahir']; ?>" class="form-control" >
		</div>
	</div>
	<label for="password">Foto</label>
	<div class="form-group">
		<div class="form-line">
			<input type="file" value="Masukkan Foto" name="foto" class="form-control" >
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
	<input type="submit" required="" name="ubah" value="Ubah Data Pegawai" class="btn btn-link waves-effect" >
	<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
</div>

</form>