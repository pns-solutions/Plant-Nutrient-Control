<?php

namespace PNS;

class SolverResult extends BaseModel {

    const TABLENAME = 'SOLVERRESULT';

    protected $schema = [
        'createdAt' => ['type' => BaseModel::TYPE_STRING],
        'tableId' => ['type' => BaseModel::TYPE_INT   ],
        'fertilizerAmount' => ['type' => BaseModel::TYPE_ARRAY ]
    ];

    /**
     *
     * TODO: Funktion in core/functions.php auslagern oder ins Model
     *
     * Funktionsbeschreibung
     * Hinweis: Solver sollte zugunsten der Performanz erst wieder neu rechnen, wenn auch neue Daten da sind: Letztes Solver Ergebnis muss älter als neuester Tank-Messwert sein
     *
     * @return string - json
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
                    'amount' => '40',    // result in ml -> TODO: must be calculated from percentage of nutrient according to current water volume in system // TODO: Durch Variable ersetzen
                    'pumpId' => 1       // TODO: must be pumpId where fertilizerId.pumpId == pumpId.fertilizerId
                ],
                [
                    'fertilizerId' =>  2, // TODO: Durch Variable ersetzen
                    'amount' => '20',    // result in ml -> TODO: must be calculated from percentage of nutrient according to current water volume in system // TODO: Durch Variable ersetzen
                    'pumpId' => 2       // TODO: must be pumpId where fertilizerId.pumpId == pumpId.fertilizerId
                ]
            ]
        ];

        // Create new Object
        $newSolverResult = new \PNS\SolverResult($solverResult);

//        $newSolverResult->validate();
//        Saves object in Database
//        $errors = $newSolverResult->save();

        $result = '';
        if(empty($errors)) {
            // Success
            //JSON object with solver result for mqtt topic
            $result = json_encode($solverResult, 128);
        }

        return $result;
    }
}