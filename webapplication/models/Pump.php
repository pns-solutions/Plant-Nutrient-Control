<?php

namespace PNS;

class Pump
{
    protected $pumpId;
    protected $gpio;
    protected $pumpActivities;
    protected $fertilizerId;

    public function __construct($pumpId, $gpio, $pumpActivities, $fertilizerId)
    {
        $this->pumpId = $pumpId;
        $this->gpio = $gpio;
        $this->pumpActivities = $pumpActivities;
        $this->fertilizerId = $fertilizerId;
    }

    public function pumpJsonString()
    {

    }
}