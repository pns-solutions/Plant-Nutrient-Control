<?php

namespace PNS;

class Plant extends BaseModelEs
{
    protected $plantId;
    protected $name;
    protected $growthStages;
    protected $createdAt;
    protected $updatedAt;

    public function __construct($plantId, $name, $growthStages, $createdAt, $updatedAt) {
        $this->plantId = $plantId;
        $this->name = $name;
        $this->growthStages = $growthStages;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function addGrowthStageToPlant($growthStage){
        $this->growthStages[] = $growthStage;
    }

    public static function getPlants(string $where = ''){
        $plants = Plant::find('plantId');

        return $plants;
    }

    public function plantJsonString(){
        $json1 = '{
            "plantId": "' . $this->plantId . '",
            "name": "' . $this->name . '",
            "growthStages": [';

        $json2 = '';
        for ($x = 0; $x < count($this->growthStages); $x++) {
            if ($x == count($this->growthStages) - 1){
                $json2 .= $this->growthStages[$x]->growthStageJsonString();
            } else{
                $json2 .= $this->growthStages[$x]->growthStageJsonString() . ",";
            }
        }

        $json2 .= '],';
        $json3 = '
            "createdAt": "' . $this->createdAt . '",
            "updatedAt": "' . $this->updatedAt . '"
        }';

        return $json1 . $json2 . $json3;
    }
}