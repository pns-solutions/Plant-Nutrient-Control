<?php

namespace PNS;

class ArduinoStatus extends BaseModel {
    const TABLENAME = 'ARDUINOSTATUS';

    protected $schema = [
        'time'          => ['type' => BaseModel::TYPE_INT   ],
        'status'        => ['type' => BaseModel::TYPE_STRING]
    ];
}