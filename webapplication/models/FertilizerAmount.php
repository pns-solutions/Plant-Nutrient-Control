<?php

namespace PNS;

class FertilizerAmount extends BaseModel {

    const TABLENAME = 'FERTILIZERAMOUNT';

    protected $schema = [
        'fertilizerId'       => ['type' => BaseModel::TYPE_INT   ],
        'amount'             => ['type' => BaseModel::TYPE_STRING]
    ];
}