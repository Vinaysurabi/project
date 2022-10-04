<?php
session_start();
require_once "../config/db_config.php";
require_once "../config/navigation.php";

function displayAlert($alert)
{ ?>
<script type="text/javascript">
var alert_msg = "<?php echo $alert; ?>";
alert(alert_msg);
window.location.href = "update_account.php";
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

if (strlen($_POST['firstName']) < 1 || strlen($_POST['lastName']) < 1) {
    displayAlert("First/Last name cannot be blank.");
}

$email = $_SESSION["email"];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "UPDATE users set first_name = '$firstName', last_name = '$lastName' where email_id = '$email'";
echo $sql;
if ($conn->query($sql) === TRUE) {
    displaySuccessAlert("Account Details Updated");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>