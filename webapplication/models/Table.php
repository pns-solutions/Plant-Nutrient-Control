<?php

namespace PNS;

class Table extends BaseModel {

    const TABLENAME = 'TABLE';

    protected $schema = [
        'tableId'               => ['type' => BaseModel::TYPE_INT  ],
        'pumpIds'               => ['type' => BaseModel::TYPE_ARRAY],
        'valveIds'              => ['type' => BaseModel::TYPE_ARRAY],
        'cultureId'             => ['type' => BaseModel::TYPE_INT  ],
        'tankWaterLevel'        => ['type' => BaseModel::TYPE_INT  ],
        'tankVolume'            => ['type' => BaseModel::TYPE_INT  ]
    ];
}