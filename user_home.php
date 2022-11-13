<?php
session_start();

if ($_GET) {
    $_SESSION["email"] = $_GET['email'];
}
$email_id = $_SESSION["email"];
$_SESSION["email_id"] = $email_id;

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
    require_once 'init.php';
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

    </div>

    <div class="container h-100 d-flex align-items-center justify-content-center">
        <br>
        <br>
        <br>
        <div class="row form-group">
            <div class=col-sm-6 mt-5">
                <label for="register">Search ETD's</label>
            </div>
        </div>

        <form action="search_user_logged.php?email=<?php echo $email; ?>" method="get" autocomplete="off"
            enctype="multipart/form-data">

            <input type="hidden" name="email" value=<?php echo htmlspecialchars($email, ENT_QUOTES); ?>>
            <div class="row">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">

                        <input type="text" name="q" class="search-query form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" value="search">
                                <span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </form>

    </div>

</body>

</html>