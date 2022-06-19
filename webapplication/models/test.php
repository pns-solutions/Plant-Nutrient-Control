<?php

namespace PNS;
require_once '../assets/composer/vendor/autoload.php';

require_once('Nutrient.php');
require_once('GrowthStage.php');

use PDOException;
use Elasticsearch\ClientBuilder;

function buildClient(){
    return ClientBuilder::create()->build();
}

function createIndex($indexName, $client){
    $params = ['index' => $indexName];
    $client->indices()->create($params);
}

function insert($docType, $json, $client){
    $params = [
        'index' => 'ok',
        'body'  => $json
    ];

    $client->index($params);
}

//not working yet
function bulkInsert($json, $client){
    for($i = 0; $i < 3; $i++) {
        $params['body'][] = [
            'index' => [
                '_index' => 'tester',
            ]
        ];
        $params['body'][] = [
            'body'  => $json
        ];

    }
    $client->bulk($params);
}

function findByName($name, $client){
    $json = '{
        "query" : {
            "match" : {
                "name" : "' . $name . '"
            }
        }
    }';

    $params = [
        'index' => 'tester',
        'body'  => $json
    ];

    return $client->search($params);
}

//doc type needs to be the type specific id; e.g. plantId
function getAll($docType, $client){
    $json = '{
        "query": {
        "exists" : { "field" : "' . $docType . '" }
        }
    }';

    $params = [
        'index' => 'tester',
        'body'  => $json
    ];

    return $client->search($params);
}

//get all results of a specific document type
//$results = getAll('plantId', buildClient());

/*foreach($results as $re){
    echo json_encode($re);
}*/

$docType = 'plant';
//insert($docType, $json, buildClient());

$grey = new Nutrient('5','grey','gy','3ml');

$junge = new Nutrient('6','natrium','na','2ml');

$json = $grey->nutrientJsonString();
//echo gettype($json), "\n";

$tempArr[]=$grey;
$tempArr[]=$junge;

$growth = new GrowthStage('3','numberone',$tempArr,'2022','2023','3');

$ajson = $growth->growthStageJsonString();
//echo "$ajson";
//$growth->insert($ajson);
$result = $growth->find('growthStageId');

/*foreach($result as $re){
    echo json_encode($re);
}*/

$stages[]=$growth;

$orange = new Plant('9999','erdbeere',$stages,'2050','2090');
$thejson = $orange->plantJsonString();
//echo "$thejson";

$wholeJson = '
{
    "plantId": "333",
	"name": "Basilikum",
	"growthStages": [{
        "growthStageId": "3",
		 "name": "numberone",
		"nutrientArray": [{
            "nutrientId": "",
			"name": "grey",
			"element": "gy",
			"amount": "3ml"
		}, {
            "nutrientId": "",
			"name": "junge",
			"element": "ju",
			"amount": "2ml"
		}],
		"createdAt": "2022",
		"updatedAt": "2023",
		"defaultDuration": "3"
	}],
	"createdAt": "2050",
	"updatedAt": "2090"
}';

$partialJson = '
{
        "growthStageId": "5",
        "name": "pikachu",
		"nutrientArray": [{
        "nutrientId": "",
			"name": "chlor",
			"element": "cl",
			"amount": "33333ml"
		}],
		"createdAt": "2022",
		"updatedAt": "2023",
		"defaultDuration": "3"
}';

//$growth->insert($partialJson);

//$result = $growth->find('growthStageId');

/*foreach($result as $re){
    echo json_encode($re) . "\n";
}*/

//$basilikum->insert($wholeJson);

$plantJson = '{
    "plantId": "666",
    "name": "Banane",
    "growthStages": [
        {
            "growthStageId": "3",
            "name": "first",
            "nutrientArray": [
                {
                    "nutrientId": "",
                    "name": "grey",
                    "element": "gy",
                    "amount": "3ml"
                },
                {
                    "nutrientId": "",
                    "name": "chlor",
                    "element": "cl",
                    "amount": "2ml"
                }
            ],
            "createdAt": "2022",
            "updatedAt": "2023",
            "defaultDuration": "3"
        }
    ],
    "createdAt": "2050",
    "updatedAt": "2090"
}';

/*$params = [
    'index' => 'ok',
    'id' => '4567',
    'body' => $thejson
];*/

$params = [
    'index' => 'ok',
    'id' => '4567'
];

$response = $orange->insert($orange->plantJsonString());

echo "$response";
//$response = buildClient()->get($params);
//$response = buildClient()->index($params);

/*foreach($response as $re){
    echo json_decode($re);
}*/
