
<!-- Basic Alerts -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    KEPUTUSAN
                    <small></small>
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
                <div class="alert alert-warning">
                    <strong>Penilaian dari Tim Penilai Belum Selesai ! </strong> Keputusan belum bisa dilakukan
                </div>

                <?php
                $cek = $link-> query("SELECT * FROM penilai WHERE id_user<>1");
                while($data = mysqli_fetch_array($cek)){
                    $id_penilai = $data['id_penilai'];
                    $query2 = $link-> query("SELECT * from nilai_pegawai where id_penilai='$id_penilai'");
                    $juml = mysqli_num_rows($query2);
                    if($juml==0){
                        ?>

                          <div class="alert alert-info">
                <strong><?= $data['nama']; ?></strong> Belum Melakukan Penilaian  <a href="?module=email&kd=<?=$data['id_penilai'];?>" class="alert-link">KIRIM EMAIL dan notifikasi</a>
            </div>

                     <?php 
                 }
                 if($juml<$jumlahp){ ?>
                    <div class="alert alert-info">
                <strong><?= $data['nama']; ?></strong> Belum Selesai melakukan Penilaian  <a href="?module=email&kd=<?=$data['id_penilai'];?>" class="alert-link">KIRIM EMAIL dan notifikasi</a>
            </div>
             <?php  } } ?>

           
        </div>
    </div>
</div>
</div>
<!-- #END# Basic Alerts -->
            <!-- Material Design Alerts -->