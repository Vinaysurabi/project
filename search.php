<?php

require_once 'init.php';
header("Content-Type:application/json");

if (isset($_GET['value']) && $_GET['value'] != "") {
    $value = $_GET['value'];

    if (isset($_GET['range']) && $_GET['range'] != "") {
        $size = $_GET['range'];
    } else {
        $size = 10;
    }

    $from = 0;

    $query = $es->search([
        'index' => 'etd',
        'from' => 0,
        'size' => $size,
        'type' => '_doc',
        'body' => [
            'query' => [
                'multi_match' => [
                    'query' => $value,
                    'fields' => ['title', 'author'],
                    'operator' => 'and',
                    'type' => 'cross_fields'
                ]
            ]
        ]
    ]);

    if ($query['hits']['total'] >= 1) {
        $results = $query['hits']['hits'];
        response($results);
    } else {
        response("No Record Found");
    }
} else {
    response("Invalid Request");
}

function response($results)
{
    $json_response = json_encode($results);
    echo $json_response;
}