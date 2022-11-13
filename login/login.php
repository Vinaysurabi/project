<!-- comment -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Digital Library Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <form action="login_btn_action.php" method="post">
            <!-- <div class="row"> -->
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                        placeholder="Email-Id">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sign In</button>
            <!-- </div> -->
            <div class="row form-group"></div>
            <div class="row form-group"></div>
            <div class="row form-group"></div>

            <div class="row form-group">
                <div class=col-sm-6 mt-5">
                    <label for="register">Not Registered?</label>
                    <a class="btn btn-primary" href="../registration/registration.php" role="button">Register</a>

                </div>
            </div>

            <div class="row form-group">
                <div class=col-sm-6 mt-5">
                    <label for="forgotpwd">Forgot Password?</label>
                    <a class="btn btn-primary" href="../password/forgot_password.php" role="button">Forgot Password</a>

                </div>
            </div>

        </form>

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
        <form action="../search_before_signin.php" method="get" autocomplete="off">
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