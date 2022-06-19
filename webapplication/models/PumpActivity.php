<?php

namespace PNS;

class PumpActivity extends BaseModel {

    const TABLENAME = 'PUMPACTIVITY';

    protected $schema = [
        'pumpId'                => ['type' => BaseModel::TYPE_INT   ],
        'activityBegin'         => ['type' => BaseModel::TYPE_STRING],
        'activityEnd'           => ['type' => BaseModel::TYPE_STRING],
        'targetActiveTime'      => ['type' => BaseModel::TYPE_STRING],
        'pumpVolume'            => ['type' => BaseModel::TYPE_STRING]
    ];
}