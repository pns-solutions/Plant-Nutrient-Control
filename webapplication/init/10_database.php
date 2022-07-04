<?php

use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

const INDEX = 'pns';

$elasticsearchConnection = null;
$lastInsertedId = null;
$server = '192.168.178.74';

try {
    $elasticsearchConnection = ClientBuilder::create()->setHosts(['51.75.64.177'])->build();
    $indexExists = $elasticsearchConnection->indices()->exists(['index' => 'pns']);

    if(!$indexExists) {
        $elasticsearchConnection->indices()->create(['index' => 'pns']);
    }
} catch (Missing404Exception $e) {
    die('Verbindung nicht möglich!');
} catch (\Elasticsearch\Common\Exceptions\NoNodesAvailableException $e) {
    die('Keine Laufende Elasticsearch Instanz gefunden!');
}