<?php
$mail->isSMTP();
$mail->Host = 'mail.mijndomein.nl';
$mail->SMTPAuth = true;
$mail->Username = 'test@amkuperus.nl';
$mail->Password = '';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('test@amkuperus.nl', 'AMKuperus');//Sender

$mailUrl = 'http://127.0.0.1:8080/';
?>
