<?php
require_once "config/db_config.php";

function displayAlert($alert)
{ ?>
    <script type="text/javascript">
        var alert_msg = "<?php echo $alert; ?>";
        alert(alert_msg);
        window.location.href = "login/login.php";
    </script>
<?php }

$emailId = $_GET['email'];
$code = $_GET['code'];

$conn = new mysqli($servername, $username, $password, $dbname);
$query = "SELECT verified_email FROM users WHERE email_id = '$emailId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if ($row['verified_email'] == $code) {
    $query = "UPDATE users set verified_email = 1 where email_id = '$emailId'";
    mysqli_query($conn, $query);
    displayAlert("Email has been successfully verfied");
} else {
    displayAlert("Email verfication failed, please use the correct link");
}
?>