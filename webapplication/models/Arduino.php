<?php

namespace PNS;

class Arduino
{
    protected $arduinoId;
    protected $ipAddress;
    protected $lastPing;
    protected $arduinoStatus;

    public function __construct($arduinoId, $ipAddress, $lastPing, $arduinoStatus) {
        $this->arduinoId = $arduinoId;
        $this->ipAddress = $ipAddress;
        $this->lastPing = $lastPing;
        $this->arduinoStatus = $arduinoStatus;
    }

    public function arduinoJsonString(){
        $json1 = '{
            "arduinoId": "' . $this->arduinoId . '",
            "ipAddress": "' . $this->ipAddress . '",
            "lastPing": "' . $this->lastPing . '",
            "arduinoStatus": [';

        $json2 = '';
        for ($x = 0; $x < count($this->arduinoStatus); $x++) {
            if ($x == count($this->arduinoStatus) - 1){
                $json2 .= $this->arduinoStatus[$x]->nutrientJsonString();
            } else{
                $json2 .= $this->arduinoStatus[$x]->nutrientJsonString() . ",";
            }
        }
        $json2 .= ']}';
        return $json1 . $json2;
    }
}