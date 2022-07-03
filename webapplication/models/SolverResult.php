<?php

namespace PNS;

use PhpMqtt\Client\Exceptions\ConfigurationInvalidException;
use PhpMqtt\Client\Exceptions\ConnectingToBrokerFailedException;
use PhpMqtt\Client\Exceptions\ProtocolNotSupportedException;
use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

class SolverResult extends BaseModel {

    const TABLENAME = 'solverResult';

    protected $schema = [
        'createdAt' => ['type' => BaseModel::TYPE_STRING],
        'tableId' => ['type' => BaseModel::TYPE_INT   ],
        'fertilizerAmount' => ['type' => BaseModel::TYPE_ARRAY ]
    ];

    /**
     * Funktionsbeschreibung:
     * Berechnet Differenz des Pflanzen- PH- sowie Nährstoffbedarfs zu aktuellen Messwerten der Nährläsung (Soll vs Ist)
     * und sucht eine mögliche Kombination von Düngemitteln und deren benötigte Menge, um diese Diskrezpanz zu überbrücken.
     * Dabei ist eine Standardungenauigkeit von 15% in Ordnung.
     * Es soll priorisiert der PH-Wert korrigiert werden.
     * Das Ergebnis wird in die DB gespeichert und die Ausgabe kann als JSON für MQTT weiterverwendet werden -> siehe solver_controller
     * Hinweis: Solver sollte zugunsten der Performanz erst wieder neu rechnen, wenn auch neue Daten da sind: Letztes Solver Ergebnis muss älter als neuester Tank-Messwert sein
     *
     * @return string
     */
    public static function solveNutrientSolution(): string {

        // TODO: Fetch current Measurement for PH and Nutrients
        // TODO: Fetch Culture/Plants needs -> target value
        // TODO: Calculate discrepancy of current Measurements and target value
        // TODO: Implement Logic for solver -> Search for a combination of fertilizers to satisfy the plants nutrient need in regard to the discrepancy

        $time = new \DateTime('now');
        // Dummy Result
        $solverResult = [
            'createdAt' => $time->format('Y-m-d H:i:s'), // 2022-10-02 12:50:36
            'tableId' => 1, // TODO: Durch Variable ersetzen
            'fertilizerAmount' => [
                [
                    'fertilizerId' =>  1, // TODO: Durch Variable ersetzen
                    'amount' => 40,    // result in ml -> TODO: must be calculated from percentage of nutrient according to current water volume in system // TODO: Durch Variable ersetzen
                    'pumpId' => 1       // TODO: must be pumpId where fertilizerId.pumpId == pumpId.fertilizerId
                ],
                [
                    'fertilizerId' =>  2, // TODO: Durch Variable ersetzen
                    'amount' => 20,    // result in ml -> TODO: must be calculated from percentage of nutrient according to current water volume in system // TODO: Durch Variable ersetzen
                    'pumpId' => 2       // TODO: must be pumpId where fertilizerId.pumpId == pumpId.fertilizerId
                ]
            ]
        ];

        // Create new Object
        $newSolverResult = new \PNS\SolverResult($solverResult);

        $validationError = [];
        $newSolverResult->validate($validationError);

        if(!empty($validationError)) {
            return json_encode($validationError, 128);
        }
        //        Saves object in Database
        $errors = $newSolverResult->save();

        if(empty($errors)) {
            // Success
            // JSON object with solver result for mqtt topic
            return json_encode($solverResult, 128);
        }

        return json_encode($errors, 128);
    }

    public static function runSolver() {
        $port = 8883;
        $clientId = rand(5, 15);

        $connectionSettings = new ConnectionSettings();
        $server = $GLOBALS['server'];

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

        $message = \PNS\SolverResult::solveNutrientSolution();

        $mqtt->publish('solverResult', $message);
        error_to_logFile("WAS HERE");

        return $message;
    }
}