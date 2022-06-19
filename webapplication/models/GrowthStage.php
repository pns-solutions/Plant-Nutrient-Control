<?php

namespace PNS;

class GrowthStage extends BaseModel {
    
    const TABLENAME = 'GROWTHSTAGE';

    protected $schema = [
        'growthStageId'       => ['type' => BaseModel::TYPE_INT   ],
        'name'                => ['type' => BaseModel::TYPE_STRING],
        'nutrientArray'       => ['type' => BaseModel::TYPE_ARRAY ],
        'createdAt'           => ['type' => BaseModel::TYPE_STRING],
        'upadtedAt'           => ['type' => BaseModel::TYPE_STRING],
        'defaultDuration'     => ['type' => BaseModel::TYPE_STRING]
    ];
}
