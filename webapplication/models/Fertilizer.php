<?php

namespace PNS;

class Fertilizer extends BaseModelEs
{
    protected $fertilizerId;
    protected $name;
    protected $nutrientArray;
    protected $tableId;
    protected $createdAt;
    protected $updatedAt;

    public function __construct($fertilizerId, $name, $nutrientArray, $tableId, $createdAt, $updatedAt) {
        $this->fertilizerId = $fertilizerId;
        $this->name = $name;
        $this->nutirentArray = $nutrientArray;
        $this->tableId = $tableId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function fertilizerJsonString(){
        $json1 = '{
            "fertilizerId": "' . $this->fertilizerId . '",
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
            "tabledId": "' . $this->tableId . '",
            "createdAt": "' . $this->createdAt . '",
            "updatedAt": "' . $this->updatedAt . '"
        }';

        return $json1 . $json2 . $json3;
    }
}