<?php

require('../assets/composer/vendor/autoload.php');
//require('../core/functions.php');
//require('../init/10_database.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;


$server = '192.168.0.102';
//$server = 'localhost';
$port = 8883;
$clientId = rand(5, 15);
//$clientId = 'test-publisher';

$connectionSettings = new ConnectionSettings();
$mqtt = new MqttClient($server, $port, $clientId);

$mqtt->connect($connectionSettings, false);

$message = \PNS\SolverResult::solveNutrientSolution();
$mqtt->publish('solverResult', $message);