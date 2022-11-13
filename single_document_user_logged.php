<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$_SESSION["email"] = str_replace("%40", "@", $_GET['email']);
?>

<?php
header('Access-Control-Allow-Headers: *');
require_once 'init.php';


if (isset($_GET['id'])) {
    $data = $_GET['id'];

    $query = $es->search([
        'index' => 'etd',
        'type' => '_doc',
        'body' => [
            'query' => [
                'match'  => ['_id' => $data],

            ]

        ]

    ]);
    if ($query['hits']['total'] >= 1) {
        $results = $query['hits']['hits'];

        foreach ($results as $r) {
            $title = $r['_source']['title'];
            $year = $r['_source']['year'];
            $author = $r['_source']['author'];
            $advisor = $r['_source']['advisor'];
            $university = $r['_source']['university'];
            $author = $r['_source']['author'];
            $degree = $r['_source']['degree'];
            $program = $r['_source']['program'];
            $text = $r['_source']['text'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Search | Online Books Search</title>
    <meta name="description" content="search-results">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

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


<?php
require_once "config/navigation.php";
require_once "config/db_config.php";
?>


<body>


    <br>
    <br>
    <br>
    <br>

    <br>

    <div id="listId">
        <ul class="list">
            <div class="row" style="text-align: center">
                <div class="container">
                    <div class="panel panel-success">
                        <div class=panel-heading>
                            <h2 class=panel-title>
                                <b>Title:</b>

                                <?php
                                echo $title; ?>
                                <p></p>
                        </div>
                        <b>Author:</b>
                        <center>
                            <?php
                            echo $author; ?>
                        </center>
                        <br>
                        <b>Year</b>
                        <center>
                            <?php echo $year; ?>
                        </center>
                        <br>
                        <b>Advisor:</b>
                        <center>
                            <?php echo $advisor; ?>
                        </center>
                        <br>
                        <b>University:</b>
                        <center>
                            <?php echo $university; ?>
                        </center>
                        <br>
                        <b>Degree:</b>
                        <center>
                            <?php echo $degree; ?>
                        </center>
                        <br>
                        <b>Program:</b>
                        <center>
                            <?php echo $program; ?>
                        </center>
                        <br>
                        <b>DocId:</b>
                        <center>
                            <a href="<?php echo "/PROJECT/PDF/" . $r['_source']['etd_file_id'] . ".pdf"; ?>" target="_blank">

                                <?php echo $r['_source']['etd_file_id']; ?>.pdf

                            </a>
                        </center>
                        <br>
                        <b>Abstract:</b>
                        <center>
                            <?php echo $r['_source']['suthor']; ?>
                        </center>
                        <br>

                    </div>
                </div>
            </div>
        </ul>
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

</body>

</html>