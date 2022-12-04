<!DOCTYPE html>
<html lang="en">

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
        <h2>Forgot Password</h2>
        <br>
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Enter your Email:</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
        <?php
    if ($_POST) {
      $email = $_POST['email'];
      header("location: ../login/login_auth.php?email=$email&reset=1");
    }
    ?>
    </div>
    <footer>
        <p>Digital Library Copyright &copy;<?php $today = date("Y");
                                        echo $today ?>.</p>
    </footer>



</body>

</html>