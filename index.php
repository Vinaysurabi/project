<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

    .body {
        margin: 0;
        padding: 0;
    }

    .form {
        background-color: #39B54A;
        width: 750px;
        height: 44px;
        border-radius: 15px;
        display: flex;
        flex-direction: row;
        align-items: center;
        float: left;
    }

    .input {
        all: unset;
        font: 16px system-ui;
        color: #fff;
        height: 100%;
        width: 100%;
        padding: 6px 10px;
    }

    #logo {
        width: 100%;
        height: 40%;
        margin: 0px;
        float: center;
    }

    ::placeholder {
        color: #fff;
        opacity: 0.7;
    }

    svg {
        color: #fff;
        fill: currentColor;
        width: 24px;
        height: 24px;
        padding: 10px;
    }

    button {
        all: unset;
        cursor: pointer;
        width: 44px;
        height: 44px;
    }

    .below-bar {

        width: 1000px;
        height: 100px;
        margin: 10px 40px;
    }
    </style>
</head>

<body>

    <div class="container">
        <!-- <img src="digital-library-img.jpg" id="logo"> -->
        <!-- <img src="digital-library-img.jpg" style="width:70%" > -->
        <img src="digital-library-img.jpg" id="logo">
        <a class="btn" href="login/login.php" role="button">Login</a>

    </div>

</body>

<br>


<div id="second-bar">
    <span class=below-bar></span>

</div>

</html>