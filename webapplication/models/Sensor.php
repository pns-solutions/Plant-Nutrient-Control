<?php

namespace PNS;

class Sensor
{
    const TABLENAME = 'SENSOR';

    protected $schema = [
        'sensorId'          => ['type' => BaseModel::TYPE_INT   ],
        'unit'              => ['type' => BaseModel::TYPE_STRING],
        'topic'             => ['type' => BaseModel::TYPE_STRING]
    ];
}