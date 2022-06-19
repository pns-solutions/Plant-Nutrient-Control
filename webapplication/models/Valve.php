<?php

namespace PNS;

class Valve
{
    protected $valveId;
    protected $gpio;
    protected $valveActivities;

    public function __construct($valveId, $gpio, $valveActivities)
    {
        $this->valveId = $valveId;
        $this->gpio = $gpio;
        $this->valveActivities = $valveActivities;
    }

    public function valveJsonString()
    {

    }
}