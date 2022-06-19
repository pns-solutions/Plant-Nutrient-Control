<?php

namespace PNS;

class PumpActivity
{
    protected $pumpId;
    protected $activityBegin;
    protected $activityEnd;
    protected $targetActiveTime;
    protected $pumpVolume;

    public function __construct($pumpId, $activityBegin, $activityEnd, $targetActiveTime, $pumpVolume)
    {
        $this->pumpId = $pumpId;
        $this->activityBegin = $activityBegin;
        $this->activityEnd = $activityEnd;
        $this->targetActiveTime = $targetActiveTime;
        $this->pumpVolume = $pumpVolume;
    }

    public function pumpActivityJsonString()
    {

    }
}