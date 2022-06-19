<?php

namespace PNS;

class TankWaterLevel extends BaseModel {

    const TABLENAME = 'TANKWATERLEVEL';

    protected $schema = [
        'time'                     => ['type' => BaseModel::TYPE_STRING],
        'waterLevel'               => ['type' => BaseModel::TYPE_INT   ]
    ];
}