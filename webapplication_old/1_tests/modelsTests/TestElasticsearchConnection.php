<?php

namespace PNS;
require '../../core/functions.php';

use Elasticsearch\ClientBuilder;
use PHPUnit\Framework\TestCase;

class TestElasticsearchConnection extends TestCase{

    public function testConnection() {
        $client = ClientBuilder::create()->setHosts(['51.75.64.177'])->build();
        $this->assertNotNull($client);
    }

    public function testCreateFile() {
        $client = ClientBuilder::create()->setHosts(['51.75.64.177'])->build();

        $params = [
            'index' => 'test_table',
            'id' => 125,
            'body' => [
                'name' => 'Lukas',
                'age' => 23,
                'sex' => 'male'
            ]
        ];

        $result = $client->index($params);

//        error_to_phpunit_output($result);
    }


}
