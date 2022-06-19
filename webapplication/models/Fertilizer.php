<?php

namespace PNS;

class Fertilizer extends BaseModel {

    const TABLENAME = 'FERTILIZER';

    protected $schema = [
        'fertilizerId'       => ['type' => BaseModel::TYPE_INT   ],
        'name'               => ['type' => BaseModel::TYPE_STRING],
        'nutrientArray'      => ['type' => BaseModel::TYPE_ARRAY ],
        'tabledId'           => ['type' => BaseModel::TYPE_INT   ],
        'createdAt'          => ['type' => BaseModel::TYPE_STRING],
        'updatedAt'          => ['type' => BaseModel::TYPE_STRING]
    ];
}