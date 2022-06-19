<?php

namespace PNS;

class Valve extends BaseModel {

    const TABLENAME = 'VALVE';

    protected $schema = [
        'valveId'               => ['type' => BaseModel::TYPE_INT   ],
        'gpio'                  => ['type' => BaseModel::TYPE_STRING],
        'valveActivities'       => ['type' => BaseModel::TYPE_ARRAY ]
    ];
}