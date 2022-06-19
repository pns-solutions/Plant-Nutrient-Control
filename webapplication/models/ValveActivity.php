<?php

namespace PNS;

class ValveActivity extends BaseModel {

    const TABLENAME = 'VALVEACTIVITY';

    protected $schema = [
        'valveId'               => ['type' => BaseModel::TYPE_INT   ],
        'activityBegin'         => ['type' => BaseModel::TYPE_STRING],
        'activityEnd'           => ['type' => BaseModel::TYPE_STRING],
        'targetActiveTime'      => ['type' => BaseModel::TYPE_STRING],
        'state'                 => ['type' => BaseModel::TYPE_STRING]
    ];
}