<?php

namespace PNS;

class SensorMeasurement extends BaseModel {

    const TABLENAME = 'sensormeasurement';

    protected $schema = [
        'sensorId'              => ['type' => BaseModel::TYPE_INT   ],
        'timestamp'             => ['type' => BaseModel::TYPE_STRING],
        'topic'                 => ['type' => BaseModel::TYPE_STRING],
        'reading'               => ['type' => BaseModel::TYPE_INT   ],
        'convertedReading'      => ['type' => BaseModel::TYPE_INT   ],
        'unit'                  => ['type' => BaseModel::TYPE_STRING],
        'tableId'               => ['type' => BaseModel::TYPE_INT   ]
    ];
}