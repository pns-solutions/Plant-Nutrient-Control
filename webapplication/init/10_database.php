<?php

use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

const INDEX = 'pns';

$elasticsearchConnection = null;
$lastInsertedId = null;

try {
    $elasticsearchConnection = ClientBuilder::create()->setHosts(['51.75.64.177'])->build();
} catch (Missing404Exception $e) {
    die('Verbindung nicht möglich!');
}

