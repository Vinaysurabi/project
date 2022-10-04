<?php
require_once "../config/db_config.php";

function displayAlert($alert)
{ ?>
<script type="text/javascript">
var alert_msg = "<?php echo $alert; ?>";
alert(alert_msg);
window.location.href = "reset_password.php";
</script>
<?php }

function displaySuccessAlert($alert)
{ ?>
<script type="text/javascript">
var alert_msg = "<?php echo $alert; ?>";
alert(alert_msg);
window.location.href = "../login/login.php";
</script>
<?php }

echo $_POST["email"];

if (strlen($_POST['newPassword']) < 1 || strlen($_POST['confirmPassword']) < 1) {
    displayAlert("Password field cannot be blank");
}

$email = $_POST["email"];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($newPassword == $confirmPassword) {
    echo "Both passwords match <br>";
    $hash = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
    echo "Generated hash: " . $hash . "<br>";
    $query = "UPDATE users set password = '$hash' where email_id = '$email'";
    mysqli_query($conn, $query);
    displaySuccessAlert("Password has been updated sucessfully!");
} else {
    displayAlert("Passwords did not match. Please Try Again!!");
}
?>