<?php

namespace PNS;

class Table
{
    protected $tableId;
    protected $pumpIds; //array or string?
    protected $valveIds; //array or string?
    protected $cultureId;
    protected $tankWaterLevel;
    protected $tankVolume;

    public function __construct($tableId, $pumpIds, $valveIds, $cultureId, $tankWaterLevel, $tankVolume)
    {
        $this->tableId = $tableId;
        $this->pumpIds = $pumpIds;
        $this->valveIds = $valveIds;
        $this->cultureId = $cultureId;
        $this->tankWaterLevel = $tankWaterLevel;
        $this->tankVolume = $tankVolume;
    }

    public function tableJsonString()
    {

    }
}