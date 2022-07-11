<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "PHPMailer/src/Exception.php";
    require "PHPMailer/src/PHPMailer.php";

    $mail = new PHPMailer(true);
	
    $mail->CharSet = "UTF-8";
    $mail->IsHTML(true);

    $name = $_POST["name"];
    $email = $_POST["email"];
	$phone = $_POST["phone"];
    $message = $_POST["message"];
	$email_template = "template_mail.html";

    $body = file_get_contents($email_template);
	$body = str_replace('%name%', $name, $body);
	$body = str_replace('%email%', $email, $body);
	$body = str_replace('%phone%', $phone, $body);
	$body = str_replace('%message%', $message, $body);

    $mail->addAddress("archypasha@gmail.com");   // Здесь введите Email, куда отправлять
	$mail->setFrom($email);
    $mail->Subject = "[Заявка с сайта]";
    $mail->MsgHTML($body);

    if (!$mail->send()) {
        $message = "fail";
    } else {
        $message = "Message has been sent";
    }
	
	$response = ["message" => $message];

    header('Content-type: application/json');
    echo json_encode($response);
?>