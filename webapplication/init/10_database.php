<?php

use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

const INDEX = 'pns';

$elasticsearchConnection = null;

try {
//    error_to_logFile('verbunden');
    $elasticsearchConnection = ClientBuilder::create()->setHosts(['192.168.0.102'])->build();
} catch (Missing404Exception $e) {
//    error_to_logFile('Verbindung nicht möglich!');
    die('Verbindung nicht möglich!');
}

