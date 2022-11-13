<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Account Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                <li><a href="../PROJECT/login/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Update Your Account Details</h2>
        <br>
        <form class="form-horizontal" action="update_account_btn_action.php" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="firstName">First Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="firstName" placeholder="John" name="firstName">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lastName">Last Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="lastName" placeholder="Thomas" name="lastName">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>