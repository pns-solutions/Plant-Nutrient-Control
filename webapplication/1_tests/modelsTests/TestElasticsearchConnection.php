<?php

namespace PNS;
require '../../core/functions.php';
require '../../assets/composer/vendor/autoload.php';
require '../../init/10_database.php';

use Elasticsearch\ClientBuilder;
use PHPUnit\Framework\TestCase;

class TestElasticsearchConnection extends TestCase{

    public $client = null;

    public function __construct(string $name = null, array $data = [], $dataName = '') {
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

        $params = [ // start culture
            'plantId'       => null,
            'name'          => 'GHI',
            'growthStages'  => [ // start stage array
                [ // start stage
                'growthStageId' => 1,
                'name' => 'FirstOne',
                'nutrientArray' => [ // start nutrient array
                    [ // start nutrient
                        'nutrientId' => 1,
                        'name' => 'Phosphor',
                        'element' => 'P',
                        'amount' => 10
                    ],// end nutrient
                    [// start nutrient
                        'nutrientId' => 2,
                        'name' => 'Kalium',
                        'element' => 'Kl',
                        'amount' => 50
                    ]// end nutrient
                ], // end nutrient array
                'createdAt'     => $time->format('Y-m-d H:i:s'),
                'updatedAt'     => $time->format('Y-m-d H:i:s'),
                'defaultDuration' => 3
                ], //end stage
                [ // start stage
                    'growthStageId' => 1,
                    'name' => 'SecondOne',
                    'nutrientArray' => [ // start nutrient array
                        [ // start nutrient
                            'nutrientId' => 1,
                            'name' => 'Kalium',
                            'element' => 'K',
                            'amount' => 101
                        ],// end nutrient
                        [// start nutrient
                            'nutrientId' => 2,
                            'name' => 'Kalium',
                            'element' => 'Kl',
                            'amount' => 50
                        ]// end nutrient
                    ], // end nutrient array
                    'createdAt'     => $time->format('Y-m-d H:i:s'),
                    'updatedAt'     => $time->format('Y-m-d H:i:s'),
                    'defaultDuration' => 3
                ] //end stage
            ], // end stage array
            'createdAt'     => '17.06.2022',
            'updatedAt'     => '17.06.2022'
        ]; // end culture

        $newCulture = new Culture($params);

        $error = $newCulture->save();

        error_to_phpunit_output($error);
    }

    public function testDeleteMethod() {
        $where = 'LpNOgYEBF0QE60jjAqV6';

        $error = Culture::deleteWhere($where);

        error_to_phpunit_output($error);
    }

}
