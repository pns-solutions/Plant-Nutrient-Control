<?php

require('../assets/composer/vendor/autoload.php');
require('../core/functions.php');
require('../init/10_database.php');

use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\Exceptions\ConfigurationInvalidException;
use PhpMqtt\Client\Exceptions\ConnectingToBrokerFailedException;
use PhpMqtt\Client\Exceptions\DataTransferException;
use PhpMqtt\Client\Exceptions\InvalidMessageException;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\Exceptions\ProtocolNotSupportedException;
use PhpMqtt\Client\Exceptions\ProtocolViolationException;
use PhpMqtt\Client\Exceptions\RepositoryException;
use PhpMqtt\Client\MqttClient;
use PNS\SensorMeasurement;

$port = 8883;
$clientId = rand(5, 15);

$connectionSettings = new ConnectionSettings();
$server = $GLOBALS['server'];

echo $server;
try {
    $mqtt = new MqttClient($server, $port, $clientId);
} catch (ProtocolNotSupportedException $e) {
    printf("MqttClientException: There was an Error while setting up the MqttClient\n Exceptions was: %s\n", $e);

}
try {
    $mqtt->connect($connectionSettings, false);
} catch (ConfigurationInvalidException $e) {
    printf("MqttClientException: There was an Error while connect to the MqttClient\n Exceptions was: %s\n", $e);
} catch (ConnectingToBrokerFailedException $e) {
    printf("MqttClientException: There was an Error while connect to the MqttClient\n Exceptions was: %s\n", $e);

}

$mqtt->publish('debug', "I am alive.");

// TODO replace with database call
// should use all pumps and valves which are in the database
$topics = array(
    "pump/ActionStop" => 1,
    "valve/ActionStop" => 2,

    "pump/1" => 3,
    "pump/2" => 4,

    "valve/A" => 5,
    "valve/B" => 6,
    "valve/C" => 7,
    "valve/D" => 8,
);

$activePumps = array();
$activeValves = array();

foreach ($topics as $topic => $value) {
    try {
        $mqtt->subscribe($topic, function ($topic, $data) use ($mqtt, $value) {
            printf("%s\n", date('c'));
            printf("Received message on topic [%s]: %s\n", $topic, $data);

            if($topic == "pump/ActionStop") {                           // Pump Action Stop
                $activePumps[$data]['activityEnd'] = date('c');
                $activePumps[$data]->save();

            } else if($topic == "valve/ActionStop") {                   // Valve Action Stop
                $activeValves[$data]['activityEnd'] = date('c');
                $activeValves[$data]->save();


            } else if(stripos($topic, "pump/") === false) {      // Topic is valve
                $id = explode("/", $topic)[1];
                $params = array('valveId' => $id,
                                'activityBegin' => date('c'),
                                'activityEnd' => "",
                                'targetActiveTime' => $data,
                                'state' => true);
                $newActivity = new \PNS\ValveActivity($params);
                $activeValves[$id] = $newActivity;

            } else {                                                   // Topic is pump
                $id = explode("/", $topic)[1];
                $params = array( 'pumpId' => $id,
                                 'activityBegin' => date('c'),
                                 'activityEnd' => "",
                                 'targetActiveTime' => $data,
                                 'state' => true);
                $newActivity = new \PNS\PumpActivity($params);
                $activePumps[$id] = $newActivity;
            }
            $mqtt->publish('debug', json_encode($activePumps));
            $mqtt->publish('debug', json_encode($activeValves));
        }, 0);
    } catch (DataTransferException $e) {
        printf("DataTransferException: There was an Error while subscribing to [%s]\n Exceptions was: %s\n", $topic, $e);
    } catch (RepositoryException $e) {
        printf("RepositoryException: There was an Error while subscribing to [%s]\n Exceptions was: %s\n", $topic, $e);
    }
}

try {
    $mqtt->loop(true);
} catch (DataTransferException $e) {
    printf("DataTransferException: There was an Error while looping the MQTT\n Exceptions was: %s\n", $e);

} catch (InvalidMessageException $e) {
    printf("InvalidMessageException: There was an Error while looping the MQTT\n Exceptions was: %s\n", $e);

} catch (ProtocolViolationException $e) {
    printf("ProtocolViolationException: There was an Error while looping the MQTT\n Exceptions was: %s\n", $e);

} catch (MqttClientException $e) {
    printf("MqttClientException: There was an Error while looping the MQTT\n Exceptions was: %s\n", $e);

}

