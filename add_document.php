<?php
session_start();

if ($_GET) {
    $_SESSION["email"] = $_GET['email'];
}
$email_id = $_SESSION["email"];
$_SESSION["email_id"] = $email_id;
?>

<?php

require_once 'init.php';

if (!empty($_POST)) {
    if (isset(
        $_POST['title'],
        $_POST['author'],
        $_POST['year'],
        $_POST['advisor'],
        $_POST['university'],
        $_POST['degree'],
        $_POST['program']

    )) {

        $file_id = rand(1000, 10000);
        $file_name = $file_id . ".pdf";
        $target_dir = "PDF/";
        $target_file = $target_dir . basename($file_name);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }


        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $advisor = $_POST['advisor'];
        $university = $_POST['university'];
        $degree = $_POST['degree'];
        $program = $_POST['program'];
        $etd_file_id = $file_id;

        $indexed = $es->index([
            'index' => 'etd',
            'type' => '_doc',
            'body' => [
                'title' => $title,
                'author' => $author,
                'year' => $year,
                'advisor' => $advisor,
                'university' => $university,
                'degree' => $degree,
                'program' => $program,
                'etd_file_id' => $etd_file_id


            ]
        ]);
        echo "<br><br><div class='alert alert-success'> Success! The Document has been indexed.</div>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>

    <title>Digital Library Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/project/favicon_io/favicon-32x32.png">

    <style>
    h1 {
        font-family: 'Arvo', serif;
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
    <!-- Navigation bar  -->

    <!-- Body of the add -->
    <?php
    require_once "config/navigation.php";
    require_once "config/db_config.php";
    ?>

    <br><br><br>
    <form action="add_document.php" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="input-group">
                <span class="input-group-addon green" id="sizing-addon2">Title</span>
                <input type="text" name="title" class="form-control" placeholder="Title"
                    aria-describedby="sizing-addon2">
                <p>
                <p>
            </div>
        </div>
        <div class="container">
            <div class="row">
            </div>
        </div>
        <p>
            <br>
        <div class="col-lg-4 col-lg-offset-4">
            <div class="input-group">
                <span class="input-group-addon green" id="sizing-addon2">Author</span>
                <input type="text" name="author" class="form-control" placeholder="Author Name"
                    aria-describedby="sizing-addon2">
            </div>
        </div>
        <div class="container">
            <div class="row">
            </div>
        </div>

        <p>
            <br>

        <div class="col-lg-4 col-lg-offset-4">
            <div class="input-group">
                <span class="input-group-addon green" id="sizing-addon2">Year</span>
                <input type="text" name="year" class="form-control" placeholder="Year" aria-describedby="sizing-addon2">
            </div>
        </div>

        <div class="container">
            <div class="row">
            </div>
        </div>

        <p>
            <br>

        <div class="col-lg-4 col-lg-offset-4">
            <div class="input-group">
                <span class="input-group-addon green" id="sizing-addon2">Advisor</span>
                <input type="text" name="advisor" class="form-control" placeholder="Advisor"
                    aria-describedby="sizing-addon2">
            </div>
        </div>
        <div class="container">
            <div class="row">
            </div>
        </div>
        <p>
            <br>

        <div class="col-lg-4 col-lg-offset-4">
            <div class="input-group">
                <span class="input-group-addon green" id="sizing-addon2">Degree</span>
                <input type="text" name="degree" class="form-control" placeholder="Degree"
                    aria-describedby="sizing-addon2">
            </div>
        </div>
        <div class="container">
            <div class="row">
            </div>
        </div>
        <p>
            <br>

        <div class="col-lg-4 col-lg-offset-4">
            <div class="input-group">
                <span class="input-group-addon green" id="sizing-addon2">University</span>
                <input type="text" name="university" class="form-control" placeholder="University"
                    aria-describedby="sizing-addon2">
            </div>
        </div>
        <div class="container">
            <div class="row">
            </div>
        </div>
        <p>
            <br>

        <div class="col-lg-4 col-lg-offset-4">
            <div class="input-group">
                <span class="input-group-addon green" id="sizing-addon2">Program</span>
                <input type="text" name="program" class="form-control" placeholder="Program"
                    aria-describedby="sizing-addon2">
            </div>
        </div>


        <div class="col-lg-4 col-lg-offset-4">
            <div class="input-group">
                Select document to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
        </div>

        </div>
        <div class="container">
            <div class="row">
            </div>
        </div>
        <p>
            <br>
        <div class="row vertical-center-row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="center-block">
                    <center <br><input type="submit" class="btn btn-success" value="Submit">
                    </center>
                </div>
            </div>
        </div>

    </form>
    <br>
    <!-- </div> -->

    <!-- Footer -->
    <br>
    <hr> test</h2>
    <footer>
        <p>Digital Library Copyright &copy;<?php $today = date("Y");
                                            echo $today ?>.</p>
    </footer>


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="index.js"></script> -->
    <!-- <div class="row vertical-center-row">
        <footer>
            <p>Digital Library Copyright &copy;<?php $today = date("Y");
                                                echo $today ?>.</p>
        </footer>
    </div> -->
</body>

</html>