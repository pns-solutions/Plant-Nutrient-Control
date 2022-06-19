<?php

namespace PNS;

class ValveActivity
{
    protected $valveId;
    protected $activityBegin;
    protected $activityEnd;
    protected $targetActiveTime;
    protected $state;

    public function __construct($valveId, $activityBegin, $activityEnd, $targetActiveTime, $state)
    {
        $this->valveId = $valveId;
        $this->activityBegin = $activityBegin;
        $this->activityEnd = $activityEnd;
        $this->targetActiveTime = $targetActiveTime;
        $this->state = $state;
    }

    public function valveActivityJsonString()
    {

    }
}