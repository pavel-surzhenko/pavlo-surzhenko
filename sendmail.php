<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/files/PHPMailer-6.6.3/src/Exception'
require '/files/PHPMailer-6.6.3/src/PHPMailer'



$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', '/files/PHPMailer-6.6.3/language/');
$mail->isHTML(true);

$mail->setForm('pavel.surzhenko@icloud.com', 'Site');
$mail->addAddress('pavel.surzhenko@icloud.com');
$mail->Subject = 'Message from site';

if(trim(!empty(&_POST['name']))){
    $body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
}
if(trim(!empty(&_POST['email']))){
    $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
}
if(trim(!empty(&_POST['company']))){
    $body.='<p><strong>Company:</strong> '.$_POST['company'].'</p>';
}
if(trim(!empty(&_POST['message']))){
    $body.='<p><strong>Message:</strong> '.$_POST['message'].'</p>';
}
$mail->Body = $body;
if(!$mail->send()) {
    $message = 'error';
} else {
    $message = 'Message has been sent';
}
$response = ['message' => $message];
header('Content-type: application/json');
echo json_encode($response);
?>