<?php


echo 'start';

require('composer/vendor/autoload.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

$server = '192.168.178.74';
$port = 8883;
$clientId = rand(5, 15);
//$clientId = 'test-publisher';



$connectionSettings = new ConnectionSettings();
$mqtt = new MqttClient($server, $port, $clientId);

$mqtt->connect($connectionSettings, false);

//TODO: subscribe to all topics
$mqtt->subscribe('df/EC', function ($topic, $data) use ($mqtt) {
    printf(date('Y-m-d H:i:s::'));
    printf("Received message on topic [%s]: %s\n", $topic, $data);
    echo $data;
    $mqtt->publish('sensorControllerTest/EC', date('Y-m-d H:i:s::'), 0);
    //TODO save to Database
}, 0);

$mqtt->subscribe('df/PH', function ($topic, $data) {
    printf(date('Y-m-d H:i:s::'));
    printf("Received message on topic [%s]: %s\n", $topic, $data);
    //TODO save to Database
}, 0);

$mqtt->subscribe('df/KCI', function ($topic, $data) {
    printf(date('Y-m-d H:i:s::'));
    printf("Received message on topic [%s]: %s\n", $topic, $data);
    //TODO save to Database
}, 0);



$mqtt->loop(true);

