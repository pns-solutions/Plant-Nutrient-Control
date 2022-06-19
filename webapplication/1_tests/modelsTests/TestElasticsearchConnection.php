<?php

namespace PNS;
require '../../core/functions.php';
require '../../init/10_database.php';

use Elasticsearch\ClientBuilder;
use PHPUnit\Framework\TestCase;

class TestElasticsearchConnection extends TestCase{

    public $client = null;

    public function __construct(?string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);

        $this->client = ClientBuilder::create()->setHosts(['51.75.64.177'])->build();
    }

    public function testConnection() {

        $this->assertNotNull($this->client);
    }

    public function testSearchMethod() {
        $where = [
            '_id' => 'fVVXfYEBTRGddOLaKITs'
        ];

        $results = Culture::find($where);

//        foreach ($results as $result) {
//            $params = $result['_source']['culture'];
//
//            $params['plantId'] = $result['_id'];
//
//            $newCulture = new Culture($params);
//
//            error_to_phpunit_output($newCulture);
//        }


        error_to_phpunit_output($results);
    }

    public function testInsertMethod() {
        $time = new \DateTime('now');

        $params = [
            'plantId'       => null,
            'name'          => 'Test',
            'growthStages'  => [
                'growthStageId' => 1,
                'name' => 'First One',
                'nutrientArray' => [
                    [
                        'nutrientId' => 1,
                        'name' => 'Chlor',
                        'element' => 'Cl',
                        'amount' => 100
                    ],
                    [
                        'nutrientId' => 2,
                        'name' => 'Kalium',
                        'element' => 'Kl',
                        'amount' => 50
                    ]
                ],
                'createdAt'     => $time->format('Y-m-d H:i:s'),
                'updatedAt'     => $time->format('Y-m-d H:i:s'),
                'defaultDuration' => 3
            ],
            'createdAt'     => '17.06.2022',
            'updatedAt'     => '17.06.2022'
        ];

        $newCulture = new Culture($params);

        $error = $newCulture->save();

        error_to_phpunit_output($error);
    }

}
