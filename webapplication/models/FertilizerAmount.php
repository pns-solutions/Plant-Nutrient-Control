<?php

namespace PNS;

class FertilizerAmount
{
    const TABLENAME = 'FERTILIZERAMOUNT';

    protected $schema = [
        'fertilizerId'       => ['type' => BaseModel::TYPE_INT   ],
        'amount'             => ['type' => BaseModel::TYPE_STRING]
    ];
}