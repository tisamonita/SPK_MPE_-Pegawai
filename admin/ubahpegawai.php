<?php

if ($_POST['ubah']){
	$nama = $_POST['nama'];
	$bagian = $_POST['bagian'];
	$pendidikan = $_POST['pendidikan'];
	$id_pegawai = $_POST['id_pegawai'];
	$tgl_terima = $_POST['tanggal'];
	$tanggallahir = $_POST['tanggallahir'];
	$alamat = $_POST['alamat'];
	$jeniskelamin = $_POST['jeniskelamin'];
	
		$allowed_ext    = array('jpg', 'jpeg', 'png', 'PNG');
		$foto_name      = $_FILES['foto']['name'];
		$tmp            = explode('.',$_FILES['foto']['name']);
		$foto_ext       = strtolower(end($tmp));

		$foto_tmp       = $_FILES['foto']['tmp_name'];

		if(in_array($foto_ext, $allowed_ext) === true){
			$lokasi = 'images/pegawai/'.$nip.$foto_name;
			move_uploaded_file($foto_tmp, $lokasi);
			$query5 = "UPDATE pegawai set foto='$lokasi' WHERE id_pegawai='$id_pegawai'";
			$query6 = mysqli_query($link, $query5);
		}



		$query6 = "UPDATE pegawai set nama='$nama', bagian='$bagian', pendidikan='$pendidikan', tgl_skpertama='$tgl_terima', tanggal_lahir='$tanggallahir', alamat='$alamat', jeniskelamin='$jeniskelamin' WHERE id_pegawai='$id_pegawai'";
		$hasil6 = mysqli_query($link, $query6);

		if ($hasil6) {

			$_SESSION['pesan'] = 'ubah';
			echo '<script>window.location="?module=pegawai"</script>';

		}

	}

	?>
