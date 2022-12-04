<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$_SESSION["email"] = str_replace("%40", "@", $_GET['email']);
?>

<?php

require_once 'init.php';


if (isset($_GET['q'])) {
    $q = trim(strip_tags($_GET['q']));

    $from = 0;
    $size = 10;
    $query = $es->search([
        'index' => 'etd',
        'from' => 0,
        'size' => 1000,
        'type' => '_doc',
        'body' => [
            'query' => [
                'multi_match' => [
                    'query' => $q,
                    'fields' => ['title', 'author'],
                    'operator' => 'and',
                    'type' => 'cross_fields'
                ]
            ]
        ]
    ]);


    if ($query['hits']['total'] >= 1) {
        $results = $query['hits']['hits'];
    }

    $total = $query['hits']['total']['value'];

    function highlightWords($text, $word)
    {
        $text = preg_replace('#' . preg_quote($word) . '#i', '<span style="background-color: #F9F902;">\\0</span>', $text);
        return $text;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once "config/navigation.php";
require_once "config/db_config.php";
?>

<head>

    <title>Digital Library Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/project/favicon_io/favicon-32x32.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <title>Search | Document Search</title>
    <meta name="description" content="search-results">

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


    <script type="text/javascript">
    $(document).ready(function() {
        var options = {
            valueNames: ['title', 'author'],
            page: 10,
            pagination: true
        }
        var listObj = new List('listId', options);
    });
    </script>

</head>


<body>
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
    <form action="http://localhost/PROJECT/search_user_logged.php" method="get" autocomplete="on">
        <input type="hidden" name="email" value=<?php echo htmlspecialchars($email, ENT_QUOTES); ?>>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="input-group">
                    <input type="text" name="q" class="search-query form-control" value="<?php echo $q; ?>"
                        placeholder="<?php echo $q ?>">
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
            <h3> You've searched for: <?php echo $q ?></h3>

            <h3> Results found: <?php echo $total ?></h3>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row" style="text-align: center">
            <h2> Search Results: </h2>
        </div>
    </div>

    <div id="listId">
        <ul class="list">
            <?php echo $total ?>

            <?php
            for ($i = 0; $i < $total; $i++) {
            ?>
            <div class="row" style="text-align: center">
                <div class="container">
                    <div class="panel panel-success">
                        <div class=panel-heading>
                            <h2 class=panel-title>
                                <a href="<?php
                                                $output = ('http://localhost/PROJECT/single_document_user_logged.php?id=' . $results[$i]['_id']) . '&email='  . $email;

                                                echo ($output);
                                                ?>" ONCLICK=search_document('<?php echo $output; ?>') target="_blank">
                                    <p><br>
                                        <?php $title = !empty($q) ? highlightWords($results[$i]['_source']['title'], $q) : $results[$i]['_source']['title'];
                                            echo $title; ?>
                                </a>
                        </div>
                        <br><br>
                        <b>Author:</b>
                        <p>
                            <?php $author = !empty($q) ? highlightWords($results[$i]['_source']['author'], $q) : $results[$i]['_source']['author'];
                                echo $author; ?>
                        <p></p><br>
                        <b>Year</b>
                        <p>
                            <?php $year = !empty($q) ? highlightWords($results[$i]['_source']['year'], $q) : $results[$i]['_source']['year'];
                                echo $year; ?>

                        <p></p><br>
                        <b>DocId:</b>

                        <a href="<?php echo "/PROJECT/PDF/" .  $results[$i]['_source']['etd_file_id'] . ".pdf"; ?>"
                            target="_blank">

                            <?php echo  $results[$i]['_source']['etd_file_id']; ?>

                        </a>

                        <br>
                        <!-- <b>DocId:</b>
                        <center>
                            <?php echo $results[$i]['_source']['etd_file_id']; ?>
                        </center> -->
                        <br>

                    </div>
                </div>
            </div>
            <?php
            }
            ?>

        </ul>
        <center>
            <ul class="pagination"></ul>
        </center>
    </div>
    <br><br>
    <!--Footer-->
    <div class="footer">
        <div class="container">
            <p>Digital Library Copyright &copy;<?php $today = date("Y");
                                                echo $today ?>.</p>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
    function search_document(event) {

    }
    </script>



</body>

</html>