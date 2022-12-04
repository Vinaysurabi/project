<?php
require_once "../config/db_config.php";

function displayAlert($alert)
{ ?>
<script type="text/javascript">
var alert_msg = "<?php echo $alert; ?>";
alert(alert_msg);
window.location.href = "login.php";
</script>
<?php }

if ($_POST) {
    if (strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1) {
        displayAlert("Email/Password cannot be blank");
    }

    $secretkey = '6LcINwQjAAAAAD3yaletMq_PJPDrAhv21IAegJQM';
    $responsekey =  $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$responsekey";
    $response = file_get_contents($url);
    $validation = json_decode($response);
    if ($validation->success == 1) {

        $email = $_POST['email'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $query = "SELECT password FROM users WHERE email_id = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            displayAlert("Email not registered");
        } else {
            $row = mysqli_fetch_array($result);
            echo $row;

            $verify = password_verify($_POST["password"], $row['password']);

            if ($verify) {
                echo 'Password Verified! Redirect to 2FA page';
                header("location: login_auth.php?email=$email&action=login");
            } else {
                displayAlert("Incorrect Password");
            }
        }
    } else {

        displayAlert("Verify you're not a robot!");
        header("refresh:1; url=login.php");
    }
}

?>