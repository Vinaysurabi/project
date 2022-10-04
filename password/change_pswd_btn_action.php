<?php
session_start();
require_once "../config/db_config.php";
require_once "../config/navigation.php";

function displayAlert($alert)
{ ?>
<script type="text/javascript">
var alert_msg = "<?php echo $alert; ?>";
alert(alert_msg);
window.location.href = "change_password.php";
</script>
<?php }

function displaySuccessAlert($alert)
{ ?>
<script type="text/javascript">
var alert_msg = "<?php echo $alert; ?>";
alert(alert_msg);
window.location.href = "../user_home.php";
</script>
<?php }

if (strlen($_POST['currentPassword']) < 1 || strlen($_POST['newPassword']) < 1 || strlen($_POST['confirmPassword']) < 1) {
    displayAlert("Password field cannot be blank");
}

$email = $_SESSION["email"];
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];
echo "Email - ", $email;
$conn = new mysqli($servername, $username, $password, $dbname);
$query = "SELECT password FROM users WHERE email_id = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$verify = password_verify($currentPassword, $row['password']);
if ($verify) {
    if ($_POST["newPassword"] == $_POST["confirmPassword"]) {
        echo "Both passwords match <br>";
        $hash = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
        $query = "UPDATE users set password = '$hash' where email_id = '$email'";
        mysqli_query($conn, $query);
        displaySuccessAlert("Password has been successfully updated");
    } else {
        displayAlert("Passwords did not match. Please Try Again!!");
    }
} else {
    displayAlert("Incorrect Current Password Given, Please Try Again!!");
}
?>