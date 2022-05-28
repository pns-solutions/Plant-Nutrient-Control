<?php

namespace PNS;
include '../../core/functions.php';
require_once '../../init/10_database.php';

use PHPUnit\Framework\TestCase;

class PlantTest extends TestCase {

    public function testFindOne() {

        $arrayToCompareWith = [
            'ID' => '1',
            'NAME' => 'Basilikum',
            'GROWTHSTAGES' => '4'
        ];

        $plant = Plant::findOne('NAME = "Basilikum"');

        $this->assertSame($arrayToCompareWith, $plant);
    }

    public function testFind() {

        $arrayToCompareWith = [
            [
                'ID' => '1',
                'NAME' => 'Basilikum',
                'GROWTHSTAGES' => '4'
            ],
            [
                'ID' => '2',
                'NAME' => 'Thymian',
                'GROWTHSTAGES' => '2'
            ]
        ];

        $allPlants = Plant::find();

        $this->assertSame($arrayToCompareWith, $allPlants);
    }

    public function testGetPlantsWithNutrition() {
        $array = Plant::getPlantsWithNutritionAsArray();

        error_to_phpunit_output($array);
    }
}
