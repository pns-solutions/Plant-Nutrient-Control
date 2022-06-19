<?php

namespace PNS;

class Sensor
{
    protected $sensorId;
    protected $unit;
    protected $gpio;

    public function __construct($sensorId, $unit, $gpio)
    {
        $this->sensorId = $sensorId;
        $this->unit = $unit;
        $this->gpio = $gpio;
    }

    public function sensorJsonString()
    {

    }
}