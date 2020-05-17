<?php
if($_SESSION['pesan']){ ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php if($_SESSION['pesan'] =='berhasil') {
            echo "FILE BERHASIL DIUPLOAD";

        } 
        if($_SESSION['pesan'] =='ubah'){
            echo "Data Admin Berhasil Diubah";
        }

        ?>
        
    </div>

    <?php 
    unset($_SESSION['pesan']);
}

if($_POST['selesai']){
	$tanggal = $_POST['tanggal'];

	$allowed_ext    = array('pdf', 'xls', 'xlxs');
    $upload_name      = $_FILES['upload']['name'];
    $tmp            = explode('.',$_FILES['upload']['name']);
    $upload_ext       = strtolower(end($tmp));

    $upload_tmp       = $_FILES['upload']['tmp_name'];

    if(in_array($upload_ext, $allowed_ext) === true){
        $lokasi = 'history/'.$upload_name;
        move_uploaded_file($upload_tmp, $lokasi);

            $query2 = "UPDATE history set file='$lokasi' where status='konfirm'";
            $hasil2 = mysqli_query($link, $query2);

            if ($hasil2) {
            $_SESSION['pesan'] = 'berhasil';
            echo '<script>window.location="?module=proses"</script>';
            }

    }else{
        echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
        echo $upload_name;
    }
}

if($_POST['proses']) {
	$query2 = "UPDATE history set status='selesai' where status='konfirm'";
    $hasil2 = mysqli_query($link, $query2);

    $query3 = "SELECT id_pegawai FROM hasil where keputusan='berhentikan'";
    $query3 = mysqli_query($link, $query3);
    while($data = mysqli_fetch_array($query3)){
    	$id_pegawai = $data['id_pegawai'];
    	$query4 = "DELETE from pegawai WHERE id_pegawai='$id_pegawai'";
    	$query4 = mysqli_query($link, $query4);
    	     
    }

    $query3 = "SELECT id_pegawai FROM nilai_pegawai";
    $query3 = mysqli_query($link, $query3);
    while($data = mysqli_fetch_array($query3)){
    	$id_pegawai = $data['id_pegawai'];
    	$query4 = "DELETE from nilai_pegawai WHERE id_pegawai='$id_pegawai'";
    	$query4 = mysqli_query($link, $query4);
    	     
    }

    	$query5 = "TRUNCATE TABLE hasil";
       $query5 = mysqli_query($link, $query5);

       $query6 = "INSERT INTO history values('', '', '', 'belum')";
       $query6 = mysqli_query($link, $query6);

    if ($query5) {
            $_SESSION['pesan'] = 'berhasil';
            echo '<script>window.location="?module=history"</script>';
    }

}

?>


<!-- Basic Card -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					PROSES KEPUTUSAN <small>Ikuti Langkah-langkah proses keputusan</small>
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
				<h5>Langkah-Langkah Proses Keputusan </h5>
				<h4>1. DOWNLOAD  FILE</h4>
				<a href="admin/download.php" target="_blank" >
					<button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect">
                            <i class="material-icons">file_download</i>
                            <span>DOWNLOAD</span>
                    </button>
                 </a>

				<h4>2. UPLOAD </h4>
					<button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" data-toggle="modal" data-target="#keputusan2"  >
                            <span>UPLOAD</span>
                    </button>
                <br>  <br>  <br>
                <input type="checkbox" id="remember_me_4" class="filled-in">
                <label for="remember_me_4">Saya Telah Mendownload dan Meng-upload File yang benar</label>
				
			</div>
			<button type="button" class="btn btn-block btn-lg btn-success waves-effect" data-toggle="modal" data-target="#proses" >PROSES</button>
		</div>
	</div>


	<div class="modal fade" id="keputusan2" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Upload File Laporan</h4>
					</div>
					<div class="modal-body">
						<!-- Vertical Layout -->
						<div class="row clearfix">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="card">
									<div class="body">
									 <h4>	Upload File </h4>
									 <form class="form-horizontal" method="POST" enctype="multipart/form-data">
		                                <div class="row clearfix">
		                                    <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
		                                        <label for="email_address_2">Tanggal Proses</label>
		                                    </div>
		                                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
		                                        <div class="form-group">
		                                            <div class="form-line">
		                                                <input type="date" name="tanggal">
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                                 <div class="row clearfix">
		                                     <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
		                                        <label for="email_address_2">UPLOAD FILE</label>
		                                    </div>
		                                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
		                                        <div class="form-group">
		                                            <div class="form-line">
		                                                <input type="file" name="upload">
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
									</div>
								</div>
							</div>
							<!-- #END# Vertical Layout -->
						</div>
						<div class="modal-footer">
							 <input type="submit" name="selesai" class="btn btn-link waves-effect" value="Upload">
							</form>
							<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
						</div>
					
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="proses" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Konfirmasi Proses</h4>
					</div>
					<div class="modal-body">
						<!-- Vertical Layout -->
						<div class="row clearfix">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="card">
									<div class="body">
									 <h4>	PROSES KEPUTUSAN? </h4>
									 <form class="form-horizontal" method="POST" enctype="multipart/form-data">
		                               
		                                
									</div>
								</div>
							</div>
							<!-- #END# Vertical Layout -->
						</div>
						<div class="modal-footer">
							 <input type="submit" name="proses" class="btn btn-link waves-effect" value="PROSES">
							</form>
							<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
						</div>
					
				</div>
			</div>
		</div>