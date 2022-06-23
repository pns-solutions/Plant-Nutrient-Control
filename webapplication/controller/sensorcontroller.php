<?php

require('../assets/composer/vendor/autoload.php');
require('../core/functions.php');
require('../init/10_database.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;
use PNS\BaseModel;
use PNS\GrowthStage;
use PNS\SensorMeasurement;

$server = '192.168.0.102';
//$server = 'localhost';
$port = 8883;
$clientId = rand(5, 15);
//$clientId = 'test-publisher';


$connectionSettings = new ConnectionSettings();
$mqtt = new MqttClient($server, $port, $clientId);
//
$mqtt->connect($connectionSettings, false);

//TODO: subscribe to all topics

//$params = [
//    'index' => 'pns'
//];
//
//$GLOBALS['elasticsearchConnection']->indices()->create($params);


//$results =  SensorMeasurement::find(['id' => xyz]/*<-- Where Clause*/);
//$results = SensorMeasurement::find(); /*Wenn du find ohne eine Where clause aufrufst bekommst du ger ade noch alles was in der DB steht, das ändere ich aber noch!*/

//foreach ($results as $result) {
////    error_to_logFile(json_encode($result, 128));
//
//    echo json_encode($result, 128);
//}
//

$mqtt->subscribe('df/EC', function ($topic, $data) use ($mqtt) {
    printf(date('Y-m-d H:i:s::'));
    printf("Received message on topic [%s]: %s\n", $topic, $data);


    $mqtt->publish('sensorControllerTest/EC', date('Y-m-d H:i:s::'), 0);
    //TODO save to Database


    $parameter = array(
    'sensorId'              => 1,
        'time'                  => date_create(),
        'reading'               => $data,
        'convertedReading'      => $data *0.1,
        'unit'                  => "ml",
        'tableId'               => 1
    );
    $newSensorValue = new SensorMeasurement($parameter);
    $newSensorValue->save();


}, 0);
//
//$mqtt->subscribe('df/PH', function ($topic, $data) {
//    printf(date('Y-m-d H:i:s::'));
//    printf("Received message on topic [%s]: %s\n", $topic, $data);
//    //TODO save to Database
//}, 0);
//
//$mqtt->subscribe('df/KCI', function ($topic, $data) {
//    printf(date('Y-m-d H:i:s::'));
//    printf("Received message on topic [%s]: %s\n", $topic, $data);
//    //TODO save to Database
//}, 0);


$mqtt->loop(true);

