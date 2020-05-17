<?php

if($_SESSION['pesan']){ ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php if($_SESSION['pesan'] =='fotoberhasil') {
            echo "Foto Admin Berhasil Diubah";

        } 
        if($_SESSION['pesan'] =='ubah'){
            echo "Data Admin Berhasil Diubah";
        }

        ?>
        
    </div>

    <?php 
    unset($_SESSION['pesan']);
}

$query2 = "SELECT * FROM user where id_user='$id_user'";
$link2 = mysqli_query($link, $query2);
$data2 = mysqli_fetch_array($link2);


if ($_POST['ubahfoto']){
   
    $allowed_ext    = array('jpg', 'jpeg', 'png', 'PNG');
    $foto_name      = $_FILES['foto']['name'];
    $tmp            = explode('.',$_FILES['foto']['name']);
    $foto_ext       = strtolower(end($tmp));

    $foto_tmp       = $_FILES['foto']['tmp_name'];

    if(in_array($foto_ext, $allowed_ext) === true){
        $lokasi = 'images/user/'.$id_user.$foto_name;
        move_uploaded_file($foto_tmp, $lokasi);

            $query2 = "UPDATE penilai set foto='$lokasi' where id_user='$id_user'";
            $hasil2 = mysqli_query($link, $query2);

            if ($hasil2) {
            $_SESSION['pesan'] = 'fotoberhasil';
            echo '<script>window.location="?module=profile"</script>';
            }

    }else{
        echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
    }
}

if ($_POST['ubah']){
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];


    $query2 = "UPDATE penilai set nama='$nama' WHERE id_user='$id_user'";
    $hasil2 = mysqli_query($link, $query2);

    if(empty($_POST['password'])){
        $query3 = "UPDATE user set username='$username' WHERE id_user='$id_user'";
    }

    else{
        $password = md5($password);
        $query3 = "UPDATE user set username='$username', password='$password' WHERE id_user='$id_user'";
    }

    $hasil3 = mysqli_query($link, $query3);

    if ($hasil3) {

        $_SESSION['pesan'] = 'ubah';
        echo '<script>window.location="?module=profile"</script>';

    }

}


?>


<div class="row clearfix">
    <div class="col-xs-12 col-sm-8">
        <div class="card profile-card">
            <div class="profile-header">&nbsp;</div>
            <div class="profile-body">
                <div class="image-area">
                    <img src="<?= $data1['foto']; ?>" width="200px" alt="Profile Image" />

                </div>

                <div class="content-area">
                     <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#ubahfoto">Ganti Foto</button>
                    <h3><?= $data1['nama']; ?></h3>
                    <p>Administrator</p>
                    
                </div>
            </div>
            <div class="profile-footer">
                <ul>
                    <li>
                        <span>Nama</span>
                        <span><?= $data1['nama']; ?> </span>
                    </li>
                    <li>
                        <span>Username</span>
                        <span><?= $data2['username']; ?></span>
                    </li>
                </ul>
                <button type="button" class="btn btn-primary waves-effect btn-block" data-toggle="modal" data-target="#ubahprofil">Ubah Profile</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ubahprofil" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Ubah Data Admin</h4>
            </div>
            <div class="modal-body">
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="body">
                                <form method="POST">
                                    <label for="email_address">Nama</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="nama" class="form-control" value="<?= $data1['nama']; ?>">
                                        </div>
                                    </div>
                                    <label for="email_address">Username</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="username" class="form-control" value="<?= $data2['username']; ?>">
                                        </div>
                                    </div>

                                    <label for="password">Password</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" name="password" class="form-control" >
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
                    <input type="submit" required="" name="ubah" value="Ubah Data Admin" class="btn btn-link waves-effect" >
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="ubahfoto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Ubah Foto</h4>
            </div>
            <div class="modal-body">
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="body">
                                <form method="POST" enctype="multipart/form-data">
                                    <label for="password">Ubah Foto</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" name="foto" class="form-control">
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
                    <input type="submit" required="" name="ubahfoto" value="Ubah Foto" class="btn btn-link waves-effect" >
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>

            </form>
        </div>
    </div>
</div>