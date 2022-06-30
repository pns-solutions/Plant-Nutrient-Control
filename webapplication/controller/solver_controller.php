<?php

require_once(__DIR__ . '/../assets/composer/vendor/autoload.php');
require_once(__DIR__ . '/../core/functions.php');
require_once(__DIR__ . '/../init/10_database.php');

use PhpMqtt\Client\Exceptions\ConfigurationInvalidException;
use PhpMqtt\Client\Exceptions\ConnectingToBrokerFailedException;
use PhpMqtt\Client\Exceptions\ProtocolNotSupportedException;
use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

$port = 8883;
$clientId = rand(5, 15);

$connectionSettings = new ConnectionSettings();
$mqtt = new MqttClient($server, $port, $clientId);

$mqtt->connect($connectionSettings, false);

$message = \PNS\SolverResult::solveNutrientSolution();
echo $message;
$mqtt->publish('solverResult', $message);