<?php

require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "appdev@radicalnow.com";
$mail->Password = "Radical#234";
$mail->setFrom("contact@mydreamwear.com", "Mydreamwear New Contact");
$mail->addReplyTo("anand.k@radicalnow.com", "Mydreamwear Contact");
//$message = $_POST['message'];
$finalMsg='
<html>
<body>
<p><strong>Name:</strong>&nbsp; '.ucwords($_POST["name"]).'</p><p><strong>Email:</strong>&nbsp; '.$_POST["email"].'</p><p><strong>Phone:</strong>&nbsp; '.$_POST["phone"].'</p><p><strong>Message:</strong>&nbsp; '.$_POST["message"].'</p>
</body>
</html>';


$mail->addAddress("anand.k@radicalnow.com");
$mail->Subject = 'Mydreamwear New Contact Form Request';
$mail->msgHTML($finalMsg);
$mail->AltBody = 'New contact mail';
if (!$mail->send()) {
    echo "Mailer Error";
} else {
    echo "Sent";
}







?>