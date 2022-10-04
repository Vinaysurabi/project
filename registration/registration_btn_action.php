<?php
require_once "../config/db_config.php";
require_once "../config/email_config.php";

if ($_POST) {
    function displayAlert($alert)
    { ?>
        <script type="text/javascript">
            var alert_msg = "<?php echo $alert; ?>";
            alert(alert_msg);
            window.location.href = "../login/login.php";
        </script>
<?php }

    if ($_POST["password"] == $_POST["confirmPassword"]) {
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully <br>";
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $digits = 4;
    $verfcode = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

    $query = "SELECT password FROM users WHERE email_id = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        displayAlert("An account with this email-id already exists. Please log backin using the email-id provided");
    } else {
        $sql = "INSERT INTO USERS (first_name, last_name, email_id, password, verified_email) 
                VALUES ('$firstname', '$lastname', '$email', '$hash', $verfcode)";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

        $mail->addAddress($email);
        //Send HTML or Plain Text email
        $mail->isHTML(true);

        $mail->Subject = "Digital Library Verification Email";

        $mail->Body = "<a href='localhost/cs518/email_verification.php?email=$email&code=$verfcode'>Click Here to Verify your Email</a>";

        try {
            $mail->send();
            echo "Message has been sent successfully<br>";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }

    displayAlert("Registration has been completed succesfully! Please verify your email and login!");
}
?>