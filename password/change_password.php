<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
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

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Digital Library</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="../user_home.php">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['email'] ?></a></li>
                <li><a href="../PROJECT/login/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Change Your Password</h2>
        <br>
        <form class="form-horizontal" action="change_pswd_btn_action.php" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="currentPassword">Current Password:</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="currentPassword" placeholder="Current Password"
                        name="currentPassword">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="newPassword">New Password:</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="newPassword" placeholder="New Password"
                        name="newPassword">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="confirmPassword">Confirm Password:</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password"
                        name="confirmPassword">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <footer>
        <p>Digital Library Copyright &copy;<?php $today = date("Y");
                                            echo $today ?>.</p>
    </footer>


</body>

</html>