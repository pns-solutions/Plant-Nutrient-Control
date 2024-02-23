<?php

namespace PNS;

class Nutrient extends BaseModel {

    const TABLENAME = 'NUTRIENT';

    protected $schema = [
        'nutrientId'         => ['type' => BaseModel::TYPE_INT   ],
        'name'               => ['type' => BaseModel::TYPE_STRING],
        'element'            => ['type' => BaseModel::TYPE_STRING ],
        'amount'             => ['type' => BaseModel::TYPE_INT   ]
    ];
}