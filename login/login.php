<!-- comment -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Digital Library Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/project/favicon_io/favicon-32x32.png">

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
    h1 {
        font-family: Arvo, serif;
        text-align: center;
        font-size: 59px;
        position: relative;
        right: -130px;
    }

    footer {
        position: absolute;
        bottom: 0;
        text-align: center;
        width: 100%;
        padding-top: 10px;
        background: #63c5da;
    }
    </style>

</head>

<body>
    <div class="container h-100 d-flex align-items-center justify-content-center">

        <form action="login_btn_action.php" method="post">
            <!-- <div class="row"> -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                        placeholder="Email-Id">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="row form-group"></div>

            <div class="row form-group">
                <div class="form-group">
                    <div class="col-sm-6 mt-5 g-recaptcha" data-sitekey="6LcINwQjAAAAABPI_iwUnVV0iSsLIJzicIYKxReD">
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6 mt-5">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
            </div>
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

    <footer>
        <p>Digital Library Copyright &copy;<?php $today = date("Y");
                                            echo $today ?>.</p>
    </footer>


</body>

</html>