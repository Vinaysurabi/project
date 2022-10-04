<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "../vendor/autoload.php";

//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions
$mail->IsSMTP();

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->SMTPAuth   = true;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "vinaysurabitest@gmail.com";
$mail->Password   = "hawgaoqdvbtpoktl";

//From email address and name
$mail->From = "ssura005@odu.edu";
$mail->FromName = "Digital Library";