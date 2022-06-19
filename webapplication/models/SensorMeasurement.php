<?php

namespace PNS;

class SensorMeasurement
{
    protected $sensorId;
    protected $time;
    protected $reading;
    protected $convertedReading;
    protected $unit;
    protected $tabledId;

    public function __construct($sensorId, $time, $reading, $convertedReading, $unit, $tabledId)
    {
        $this->sensorId = $sensorId;
        $this->time = $time;
        $this->reading = $reading;
        $this->convertedReading = $convertedReading;
        $this->unit = $unit;
        $this->tabledId = $tabledId;
    }

    public function sensorMeasurementJsonString()
    {

    }
}