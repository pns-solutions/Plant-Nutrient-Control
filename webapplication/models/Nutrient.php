<?php

namespace PNS;

class Nutrient extends BaseModelEs
{
    protected $nutrientId;
    protected $name;
    protected $element;
    protected $amount;

    public function __construct($nutriendId, $name, $element, $amount) {
        $this->nutrientId = $nutriendId;
        $this->name = $name;
        $this->element = $element;
        $this->amount = $amount;
    }

    public function nutrientJsonString(){
        $json = '{
            "nutrientId": "' . $this->nutrientId . '",
            "name": "' . $this->name . '",
            "element": "' . $this->element . '",
            "amount": "' . $this->amount . '"
        }';

        return $json;
    }

    //returns all Nutrients
    public static function getNutrients(string $where = ''){
        $results = Plant::find('nutrientId');
        return $results;
    }
}