<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Register Your Account</h2>
        <br>
        <form class="form-horizontal" action="registration_btn_action.php" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="firstname">First Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="firstname" placeholder="John" name="firstname">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lastname">Last Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="lastname" placeholder="Thomas" name="lastname">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email-ID:</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="email" placeholder="jon@gmail.com" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="password">Password:</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="confirmPassword">Confirm Password:</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password"
                        name="confirmPassword">
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