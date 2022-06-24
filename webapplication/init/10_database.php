<?php

use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

const INDEX = 'pns';

$elasticsearchConnection = null;
$server = '192.168.178.74';

try {
//    error_to_logFile('verbunden');
    $elasticsearchConnection = ClientBuilder::create()->setHosts([$server])->build();
} catch (Missing404Exception $e) {
//    error_to_logFile('Verbindung nicht möglich!');
    die('Verbindung nicht möglich!');
}