<?php

namespace PNS;

class GrowthStage extends BaseModelEs
{
    protected $growthStageId;
    protected $name;
    protected $nutrientArray;
    protected $createdAt;
    protected $updatedAt;
    protected $defaultDuration;

    public function __construct($growthStageId, $name, $nutrientArray, $createdAt, $updatedAt, $defaultDuration) {
        $this->growthStageId = $growthStageId;
        $this->name = $name;
        $this->nutrientArray = $nutrientArray;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->defaultDuration = $defaultDuration;
    }

    public function addNutrientToGrowthStage($nutrient){
        $this->nutrientArray[] = $nutrient;
    }

    public function growthStageJsonString(){
        $json1 = '{
            "growthStageId": "' . $this->growthStageId . '",
            "name": "' . $this->name . '",
            "nutrientArray": [';

        $json2 = '';
        for ($x = 0; $x < count($this->nutrientArray); $x++) {
            if ($x == count($this->nutrientArray) - 1){
                $json2 .= $this->nutrientArray[$x]->nutrientJsonString();
            } else{
                $json2 .= $this->nutrientArray[$x]->nutrientJsonString() . ",";
            }
        }
        $json2 .= '],';
        $json3 = '
            "createdAt": "' . $this->createdAt . '",
            "updatedAt": "' . $this->updatedAt . '",
            "defaultDuration": "' . $this->defaultDuration . '"
        }';

        return $json1 . $json2 . $json3;
    }
}