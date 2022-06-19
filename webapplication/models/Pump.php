<?php

namespace PNS;

class Pump
{
    const TABLENAME = 'PUMP';

    protected $schema = [
        'pumpId'                => ['type' => BaseModel::TYPE_INT   ],
        'gpio'                  => ['type' => BaseModel::TYPE_STRING],
        'pumpActivities'        => ['type' => BaseModel::TYPE_ARRAY ],
        'fertilizerId'          => ['type' => BaseModel::TYPE_INT   ]
    ];
}