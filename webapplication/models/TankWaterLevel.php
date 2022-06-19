<?php

namespace PNS;

class TankWaterLevel
{
    protected $time;
    protected $waterLevel;

    public function __construct($time, $waterLevel)
    {
        $this->time = $time;
        $this->waterLevel = $waterLevel;
    }

    public function tankWaterLevelJsonString()
    {

    }
}