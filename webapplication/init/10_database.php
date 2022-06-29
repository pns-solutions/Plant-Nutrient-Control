<?php

use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

const INDEX = 'pns';

$elasticsearchConnection = null;
$lastInsertedId = null;
$server = '192.168.178.74';

try {
    $elasticsearchConnection = ClientBuilder::create()->setHosts([$server])->build();
} catch (Missing404Exception $e) {
    die('Verbindung nicht möglich!');
}