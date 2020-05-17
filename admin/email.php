<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$kd = $_GET['kd'];
$query = $link -> query("SELECT * FROM penilai where id_penilai='$kd'");
$data = mysqli_Fetch_Array($query);

if($_POST['kirim']){
    $to = $_POST['emailto'];
    $subject = $_POST['subject'];
    $isi = $_POST['isi'];


    require 'vendor/autoload.php';

    /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
    $mail = new PHPMailer(TRUE);

    /* Open the try/catch block. */
    $mail->setFrom('st.dhiahraniahnapian@gmail.com', 'Admin Evaluasi PTT PN Prabumulih');

    /* Add a recipient. */
    $mail->addAddress($to, 'Tim Penilai Evaluasi PTT PN Prabumulih');

    /* Set the subject. */
    $mail->Subject = $subject;

    /* Set the mail message body. */
    $mail->Body = $isi;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = 'tls';
    /* Username (email address). */
    $mail->Username = 'st.dhiahraniahnapian@gmail.com';

    /* Google account password. */
    $mail->Password = 'npcuvbwrgsxeksza';
    $mail->Port = 587;

    /* Enable SMTP debug output. */
    $mail->SMTPDebug = 4;

    $mail->send();

    /* Finally send the mail. */
    if (!$mail->send())
    {
     /* PHPMailer error. */
     echo $mail->ErrorInfo;
    }

    else {
        $_SESSION['pesan'] = 'berhasil';
        echo '<script>window.location="?module=home&kd='.$kd.'"</script>';
    }



}


?>
<!-- Horizontal Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Kirim Notifikasi dan Email
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
                <form class="form-horizontal" method="POST" >
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Alamat Email</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="emailto" class="form-control" value="<?=$data['email'];?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password_2">Subject</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="subject" class="form-control" value="Segera melakukan Penilaian Pegawai Tidak Tetap">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password_2">Isi</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">

                                    <textarea rows="4" name="isi" class="form-control no-resize auto-growth" > Penilaian terhadap pegawai kontrak belum dilakukan / belum selesai dilakukan. Segera login ke sistem dan lakukan penilaian </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="submit" name="kirim" value="Kirim Notifikasi dan Email" class="btn btn-primary m-t-15 waves-effect">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
            <!-- #END# Horizontal Layout -->