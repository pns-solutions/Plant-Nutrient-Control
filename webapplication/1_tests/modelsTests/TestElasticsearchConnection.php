<?php

namespace PNS;
require '../../core/functions.php';
require '../../config/config.php';
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
        $result = Culture::find(['culture.name' => 'Tomaten']);

        error_to_logFile(json_encode($result, 128));
   }

    public function testInsertMethod() {
        $time = new \DateTime('now');

        $params = [ // start culture
            'plantId'       => null,
            'name'          => 'Thymian',
            'growthStages'  => [ // start stage array
                [ // start stage
                'growthStageId' => "1",
                'name' => 'Reif',
                'nutrientArray' => [ // start nutrient array
                    [ // start nutrient
                        'nutrientId' => "13",
                        'name' => 'Silicium',
                        'element' => 'Si',
                        'amount' => "101"
                    ],// end nutrient
                    [// start nutrient
                        'nutrientId' => "6",
                        'name' => 'Eisen',
                        'element' => 'Fe',
                        'amount' => "50"
                    ]// end nutrient
                ], // end nutrient array
                'defaultDuration' => "2"
                ], //end stage
                [ // start stage
                    'growthStageId' => "2",
                    'name' => 'Alt',
                    'nutrientArray' => [ // start nutrient array
                        [ // start nutrient
                            'nutrientId' => "8",
                            'name' => 'Kupfer',
                            'element' => 'Cu',
                            'amount' => "101"
                        ],// end nutrient
                        [// start nutrient
                            'nutrientId' => "12",
                            'name' => 'Chlor',
                            'element' => 'Cl',
                            'amount' => "50"
                        ]// end nutrient
                    ], // end nutrient array
                    'defaultDuration' => "2"
                ] //end stage
            ], // end stage array
            'createdAt'     => "2022-10-02 12:00:00",
            'updatedAt'     => "2022-10-02 12:00:00"
        ]; // end culture

        error_to_logFile(json_encode($params));

        $newCulture = new Culture($params);

        $error = $newCulture->save();
    }

    public function testDeleteMethod() {
        $where = 'IVYDm4EBTRGddOLaXDaA';

        $error = Culture::deleteWhere($where);

        error_to_phpunit_output($error);
    }

    public function testCreateIndex() {
        $params = [
            'index' => 'pns'
        ];

       $GLOBALS['elasticsearchConnection']->indices()->create($params);
    }

    public function testJson() {

        $stringToCompareWith = '{"plantId":null,"name":"Thymian","growthStages":[{"growthStageId":"1","name":"Reif","nutrientArray":[{"nutrientId":"13","name":"Silicium","element":"Si","amount":"101"},{"nutrientId":"6","name":"Eisen","element":"Fe","amount":"50"}],"defaultDuration":"2"},{"growthStageId":"2","name":"Alt","nutrientArray":[{"nutrientId":"8","name":"Kupfer","element":"Cu","amount":"101"},{"nutrientId":"12","name":"Chlor","element":"Cl","amount":"50"}],"defaultDuration":"2"}],"createdAt":"2022-10-02 12:00:00","updatedAt":"2022-10-02 12:00:00"}';

        $arrayWithData = json_decode('{
            "plantName": "Thymian",
            "stage1_newName": "Reif",
            "stage1_Silicium": "101",
            "stage1_Eisen": "50",
            "stage1_newNutrient": "",
            "stage1_newAmount": "",
            "stage2_newName": "Alt",
            "stage2_Kupfer": "101",
            "stage2_Chlor": "50",
            "stage2_newNutrient": "",
            "stage2_newAmount": "",
            "newGrowthStageName": "",
            "newNutrient": "",
            "newAmount": "",
            "submitAddPlant": ""
        }', true);

        $growthStages = getGrowthStages($arrayWithData);
        $params = [ // start culture
            'plantId'       => null,
            'name'          => 'Thymian',
            'growthStages'  => $growthStages, // end stage array
            'createdAt'     => "2022-10-02 12:00:00",
            'updatedAt'     => "2022-10-02 12:00:00"
        ]; // end culture

     $this->assertJsonStringEqualsJsonString($stringToCompareWith, json_encode($params));
    }
}
