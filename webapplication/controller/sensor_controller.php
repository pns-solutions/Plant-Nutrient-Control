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

    try {
        $mqtt->connect($connectionSettings, false);
    } catch (ConfigurationInvalidException $e) {
        printf("MqttClientException: There was an Error while connect to the MqttClient\n Exceptions was: %s\n", $e);
    } catch (ConnectingToBrokerFailedException $e) {
        printf("MqttClientException: There was an Error while connect to the MqttClient\n Exceptions was: %s\n", $e);
    }


// replace with database call
// should use all sensors which are in the database and are active
// because the database call is asynchronous, and we should avoid such high traffic, we should use a cache.
// This cache should be updated every time a sensor is added or removed. If the cache is empty, we should use the database call.
// $newSensorValue = new Sensor();
// $newSensorValue->find()

    try {
        $mqtt->subscribe("sensorList/response", function ($topic, $data) use ($mqtt) {
            $sensorList = json_decode($data, true);
            foreach ($sensorList as $sensor) {
                try {
                    $mqtt->unsubscribe($sensor);

                    $mqtt->subscribe($sensor, function ($sensor, $data) use ($mqtt) {
                        printf("%s\n", date('c'));
                        printf("Received message on topic [%s]: %s\n", $sensor, $data);

                        $parameter = array(
                            'sensorId' => 1,
                            'timestamp' => date('c'),
                            'topic' => $sensor,
                            'reading' => floatval($data),
                            'convertedReading' => $data * 0.1,
                            'unit' => "ml",
                            'tableId' => 1
                        );
                        $newSensorValue = new SensorMeasurement($parameter);
                        $error = $newSensorValue->save();
                        foreach ($error as $errorMessage) {
                            printf("Error: %s\n", $errorMessage);
                        }

                    }, 0);
                } catch (DataTransferException $e) {
                    printf("DataTransferException: There was an Error while subscribing to [%s]\n Exceptions was: %s\n", $sensor, $e);
                } catch (RepositoryException $e) {
                    printf("RepositoryException: There was an Error while subscribing to [%s]\n Exceptions was: %s\n", $sensor, $e);
                }
            }
        }, 0);

    } catch (DataTransferException $e) {
        printf("DataTransferException: There was an Error while subscribing to sensorList/response\n Exceptions was: %s\n", $e);
    } catch (RepositoryException $e) {
        printf("DataTransferException: There was an Error while subscribing to sensorList/response\n Exceptions was: %s\n", $e);
    }

// on each start of the sensor_controller.php, we trigger the sensorList
    try {
        $mqtt->publish('sensorList/request', "");
    } catch (DataTransferException $e) {
        printf("DataTransferException: There was an Error while publishing to sensorList/request\n Exceptions was: %s\n", $e);
    } catch (RepositoryException $e) {
        printf("DataTransferException: There was an Error while publishing to sensorList/request\n Exceptions was: %s\n", $e);
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


} catch (ProtocolNotSupportedException $e) {
    printf("MqttClientException: There was an Error while setting up the MqttClient\n Exceptions was: %s\n", $e);
}




