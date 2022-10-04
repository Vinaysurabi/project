<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container {
            /* position: relative; */
            width: 100%;
            /* max-width: 1000px; */
        }

        .container img {
            width: 100%;
            height: 100%;
        }


        .container .btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: #0000FF;
            color: #FFFF00;
            font-size: 30px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }

        .container .btn:hover {
            background-color: black;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- <img src="digital-library-img.jpg" id="logo"> -->
        <img src="digital-library-img.jpg" style="width:100%">
        <a class="btn" href="login/login.php" role="button">Login</a>
        <!-- <button class="btn" href="login/login.php">Button</button> -->
    </div>

</body>

</html>