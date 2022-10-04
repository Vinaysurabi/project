<?php
require_once "email_config.php";
require_once "db_config.php";

$digits = 4;
$verfcode = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
$email = $_GET['email'];
$mail->addAddress($email);

$mail->isHTML(true);

$mail->Subject = "Digital Library Verification Email";

$mail->Body = "<a href='localhost/cs518/email_verification.php?email=$email&code=$verfcode'>Click Here to Verify your Email</a>";
echo "Sending email to " . $email . "<br>";

try {
    $mail->send();
    echo "Message has been sent successfully<br>";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

$conn = new mysqli($servername, $username, $password, $dbname);
$query = "UPDATE users set verified_email = $verfcode where email_id = '$email'";
mysqli_query($conn, $query);
