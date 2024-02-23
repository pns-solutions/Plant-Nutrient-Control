<?php

namespace PNS;

class Arduino extends BaseModel {

    const TABLENAME = 'ARDUINO';

    protected $schema = [
        'arduinoId'       => ['type' => BaseModel::TYPE_INT   ],
        'ipAddress'       => ['type' => BaseModel::TYPE_STRING],
        'lastPing'        => ['type' => BaseModel::TYPE_ARRAY ],
        'arduinoStatus'   => ['type' => BaseModel::TYPE_ARRAY ]
    ];

}