<?php
require_once "../config/email_config.php";

//To address and name
$mail->addAddress($_GET['email']); //Recipient name is optional

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Digital Library Authentication";

$digits = 4;
$authcode = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
//echo "Two Factor Auth code is ", $authcode, "<br>";

$mail->Body = "Digital Library 2FA Code - " . strval($authcode);

try {
    $mail->send();
    echo "An email has been sent with auth information<br>";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/project/favicon_io/favicon-32x32.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />

    <style>
    h1 {
        font-family: Arvo, serif;
        text-align: center;
        font-size: 59px;
        position: relative;
        right: -130px;
    }

    footer {
        position: absolute;
        bottom: 0;
        text-align: center;
        width: 100%;
        padding-top: 10px;
        background: #63c5da;
    }
    </style>

</head>

<body>
    <div class="container">
        <h2>Two Factor Authentication</h2>
        <br>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-2" for="usercode">Enter your 2FA Code:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="usercode" placeholder="4-Digit Code" name="authcode"
                        autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button onclick="myfunction()" type="button" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script>
    function myfunction() {
        var usercode = document.getElementById('usercode').value
        var authcode = "<?php echo $authcode; ?>";
        if (usercode == authcode) {
            alert("Code Successfully Verified!!");
            var email = "<?php echo $_GET['email']; ?>";
            <?php if (isset($_GET['action'])) { ?>
            window.location.href = "../user_home.php?email=" + email;
            <?php } ?>
            <?php if (isset($_GET['reset'])) { ?>
            window.location.href = "../password/reset_password.php?email=" + email;
            <?php } ?>
        } else {
            alert("Code Not Verified!! Try Login again");
            window.location.href = "login.php";
        }
    }
    </script>
    <footer>
        <p>Digital Library Copyright &copy;<?php $today = date("Y");
                                            echo $today ?>.</p>
    </footer>

</body>

</html>