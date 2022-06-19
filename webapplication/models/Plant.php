<?php

namespace PNS;

class Plant extends BaseModel {

    const TABLENAME = '`PLANT`';

    protected $schema = [
        'plantId'       => ['type' => BaseModel::TYPE_INT   ],
        'name'          => ['type' => BaseModel::TYPE_STRING],
        'growthStages'  => ['type' => BaseModel::TYPE_ARRAY],
        'createdAt'     => ['type' => BaseModel::TYPE_STRING],
        'updatedAt'     => ['type' => BaseModel::TYPE_STRING]
    ];
}