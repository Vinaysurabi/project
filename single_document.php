<?php
error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Headers: *');
require_once 'init.php';

function highlightTerms($text, $terms)
{
    $intialText = $text;
    $highlightedText = '';
    foreach ($terms as $term) {
        $termWord = $term['term'];
        $definition = getDefinition($termWord);
        $highlightedText = preg_replace(
            '#' . preg_quote($termWord) . '#i',
            '<a class = "popup" href=' . $term['url'] .  '><span style="background-color: #F9F902;">\\0</span><label>' . $termWord . ' <br></label></a>',
            $intialText
        );
        $intialText = $highlightedText;
    }

    return $highlightedText;
}

function getDefinition($termWord)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://en.wikipedia.org/w/api.php?action=query&format=json&titles=" . $termWord . "&prop=extracts&exintro=True",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Basic ZGV2OnBhc3N3b3Jk",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 4ad6e53d-a497-3c47-a992-2d59c2b8cc7e"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $string = '';
        echo "cURL Error #:" . $err;
    } else {

        $extractResponse = json_decode($response, true);
        $pages = $extractResponse['query']['pages'];
        $pageId = '';
        foreach ($pages as $key => $value) {
            $pageId = $key;
        }

        $string = substr($extractResponse['query']['pages'][$pageId]['extract'], 0, 300);
    }

    return $string;
}

if (isset($_GET['id'])) {
    $data = $_GET['id'];
    // $user =$_SESSION['email'];

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
            $terms =  $r['_source']['wikifier_terms'];
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
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="module">
    var subject = 'radiation';
    var url = 'https://en.wikipedia.org/w/api.php';
    var params = {
        'action': 'query',
        'format': 'json',
        'titles': subject,
        'prop': 'extracts',
        'exintro': "True"
    };

    console.log('test');

    const res = axios.get(url, {
            params: {
                'action': 'query',
                'format': 'json',
                'titles': subject,
                'prop': 'extracts',
                'exintro': 'True',
            }
        }).then(function(response) {
            console.log(response.data);
        })
        .catch(function(error) {
            console.log('error');
            console.error(error);
        });
    </script>


    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/project/favicon_io/favicon-32x32.png">
    <!-- <script type="text/javascript" src="result.js"></script> -->

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

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Digital Library</a>
            </div>

            <ul class="nav navbar-nav navbar-right">

                <li><a href="../PROJECT/login/login.php" data-toggle="modal"><span class=" glyphicon
                        glyphicon-log-in"></span>
                        Login Page</a>
                </li>
        </div>
    </nav>

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
                            <a href="<?php echo "/PROJECT/PDF/" . $r['_source']['etd_file_id'] . ".pdf"; ?>"
                                target="_blank">

                                <?php echo $r['_source']['etd_file_id']; ?>.pdf

                            </a>

                        </center>

                        <br>

                        <b>Abstract:</b>
                        <center>
                            <?php

                            $html_decode = html_entity_decode($terms);
                            $jsonString = str_replace("'", '"', $html_decode);

                            $terms =  json_decode($jsonString, true);

                            ?>

                            <?php $texts = !empty($text) ? highlightTerms($text, $terms) : $text;
                            echo $texts; ?>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</body>

</html>