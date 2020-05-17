<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';



try {
/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
$mail->setFrom('lokerlahat@gmail.com', 'Tisa Monita');

/* Add a recipient. */
$mail->addAddress('tisamonita1412@gmail.com', 'tisa monita');

/* Set the subject. */
$mail->Subject = 'Alhamdulillah bisa masuk';

/* Set the mail message body. */
$mail->Body = 'Masuk kan tis yo';

   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = TRUE;
   $mail->SMTPSecure = 'tls';
/* Username (email address). */
$mail->Username = 'lokerlahat@gmail.com';

/* Google account password. */
$mail->Password = 'lvskssoshunrrejz';
   $mail->Port = 587;
   
   /* Enable SMTP debug output. */
   $mail->SMTPDebug = 4;
   
   $mail->send();
}
catch (Exception $e)
{
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   echo $e->getMessage();
}

?>