<?php

require 'vendor/autoload.php';

use Elastic\Elasticsearch\ClientBuilder;

$es = ClientBuilder::create()->setHosts(['localhost:9200'])->build();