<?php
session_start();
if ($_GET) {
  $_SESSION["email"] = $_GET['email'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <?php
  require_once "config/navigation.php";
  require_once "config/db_config.php";
  ?>

    <div class="container">
        <?php
    $email = $_SESSION["email"];
    $conn = new mysqli($servername, $username, $password, $dbname);
    $query = "SELECT verified_email FROM users WHERE email_id = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if ($row['verified_email'] != 1) {
      echo "Your email is not verified. <button type='button' id='verifyemail' class='btn btn-primary'>Click</button> to send verification email. <br><br>";
    }
    ?>

        <form class="form-horizontal">
            <div class="col-sm-10">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            </div>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <script type="text/javascript">
    $("#verifyemail").click(function(e) {
        $.ajax({
            type: "GET",
            url: "config/send_verification_email.php",
            data: {
                email: "<?php echo $email; ?>"
            },
            success: function(result) {
                alert('Email Sent!!');
            },
            error: function(result) {
                alert('error');
            }
        });
    });
    </script>
</body>

</html>