<?php
session_start();
$_SESSION["email"] = str_replace("%40", "@", $_GET['email']);
?>
<?php

require_once 'init.php';

if (isset($_GET['q'])) {
    if (strlen($_GET['q']) < 1) {
        $json = '{
          "size": 50,
          "query" : {
              "match_all" : {}
          }
        }';
    } else {
        $q = $_GET['q'];
        $query = $es->search([
            'index' => 'etd',
            'type' => '_doc',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $q,
                        'fields' => ['title', 'advisor', 'year'],
                        'operator' => 'and',
                        'type' => 'cross_fields'
                    ]
                ]
            ]
        ]);

        if ($query['hits']['total'] >= 1) {
            $results = $query['hits']['hits'];
        }
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <title>Search | Document Search</title>
    <meta name="description" content="search-results">
    <!-- <meta name="author" content="Ruan Bekker"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
    <style>
        h1 {
            font-family: Arvo, serif;
            text-align: center;
            font-size: 59px;
            position: relative;
            right: -130px;
        }
    </style>
</head>

<body>

    <?php
    require_once "config/navigation.php";
    require_once "config/db_config.php";
    ?>

    <div class="container">
        <?php
        $email = $_SESSION["email"];
        // $test = $email_id;
        $conn = new mysqli($servername, $username, $password, $dbname);
        $query = "SELECT verified_email FROM users WHERE email_id = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if ($row['verified_email'] != 1) {
            echo "Your email is not verified. <button type='button' id='verifyemail' class='btn btn-primary'>Click</button> to send verification email. <br><br>";
        }
        ?>
        <script type="text/javascript">
            $("#verifyemail").click(function(e) {
                $.ajax({
                    type: "GET",
                    url: "config/send_verification_email.php",
                    data: {
                        email: "<?php echo $email; ?>"
                    },
                    success: function(result) {
                        alert('Email Sent!!');
                    },
                    error: function(result) {
                        alert('error');
                    }
                });
            });
        </script>



    </div>






    <br>

    <br>
    <br>
    <form action="search_display_home.php?email=<?php echo $email; ?>" method="get" autocomplete="on">
        <input type="hidden" name="email" value=<?php echo htmlspecialchars($email, ENT_QUOTES); ?>>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="input-group">
                    <input type="text" name="q" class="search-query form-control" placeholder="<?php echo $q ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="submit" value="search">
                            <span class=" glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </form>
    <br>

    <br>
    <div class="container">
        <div class="row" style="text-align: center">
            <h2> Search Results: </h2>
        </div>
    </div>


    <?php
    if (isset($results)) {
        foreach ($results as $r) {
    ?>

            <div class="row" style="text-align: center">
                <div class="container">
                    <div class="panel panel-success">
                        <div class=panel-heading>
                            <h2 class=panel-title>
                                <?php echo $r['_source']['title']; ?>
                                <!-- <a href="<?php echo $r['_source']['title']; ?>" target="_blank">
                            <p><br>
                                <?php echo $r['_source']['title']; ?>
                        </a> -->
                        </div>
                        <br><br>
                        <div class="row" style="text-align: center">
                            <b>Text:</b>
                            <?php echo $r['_source']['title']; ?>
                        </div>
                        <div class="row" style="text-align: center">
                            <b>Author:</b>
                            <?php echo $r['_source']['author']; ?>
                        </div>
                        <div class="">
                            <b>Year:</b>
                            <?php echo $r['_source']['year']; ?>
                        </div>
                        <div class="">
                            <b>University:</b>
                            <?php echo $r['_source']['university']; ?>
                        </div>
                        <div class="">
                            <b>Program:</b>
                            <?php echo $r['_source']['program']; ?>
                        </div>
                        <div class="">
                            <b>Degree:</b>
                            <?php echo $r['_source']['degree']; ?>
                        </div>
                        <div class="row" style="text-align: center">
                            <b>Advisor:</b>
                            <?php echo $r['_source']['advisor']; ?>
                        </div>


                        <div class="row" style="text-align: center">
                            <b>PDF:</b>
                            <a href="<?php echo "/PROJECT/PDF/" . $r['_source']['etd_file_id'] . ".pdf"; ?>" target="_blank">

                                <b> <?php echo $r['_source']['etd_file_id']; ?>.pdf</b>
                            </a>
                            <br>
                        </div>
                    </div>
                </div>
            <?php
        }
    } else if (isset($results1)) {
        foreach ($results1 as $r) {
            ?>

                <div class="row" style="text-align: center">
                    <div class="container">
                        <div class="panel panel-success">
                            <div class=panel-heading>
                                <h2 class=panel-title>
                                    <a href="<?php echo $r['_source']['title']; ?>" target="_blank">
                                        <p><br>
                                            <?php echo $r['_source']['title']; ?>
                                    </a>
                            </div>
                            <br><br>
                            <b>Content:</b>
                            <p>
                                <?php echo $r['_source']['title']; ?>
                            <p></p><br>
                            <div class="">
                                <b>DocId:</b>
                                <center>
                                    <?php echo $r['_id']; ?>
                                </center>
                                <br>
                            </div>
                        </div>
                    </div>
            <?php
        }
    }
            ?>
</body>

</html>