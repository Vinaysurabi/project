<?php
session_start();
require_once "../config/db_config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Account Details</title>
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
    <nav class=" navbar navbar-default">
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
        </div>
    </nav>

    <div class="container">
        <h2><b>Account Details</b></h2>


        <?php $email = $_SESSION["email"]; ?>
        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        $query = "SELECT * FROM users WHERE email_id = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        ?>

        <h4>First Name: <span> <?php echo $row['first_name']; ?> </span> </h4>
        <h4>Last Name: <span> <?php echo $row['last_name']; ?> </span> </h4>
        <h4>Email: <span> <?php echo $email; ?> </span> </h4>

    </div>
    <footer>
        <p>Digital Library Copyright &copy;<?php $today = date("Y");
                                            echo $today ?>.</p>
    </footer>
</body>

</html>