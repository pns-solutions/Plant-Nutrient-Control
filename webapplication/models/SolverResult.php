<?php

namespace PNS;

class SolverResult extends BaseModel {

    const TABLENAME = 'SOLVERRESULT';

    protected $schema = [
        'time'                  => ['type' => BaseModel::TYPE_STRING],
        'tableId'               => ['type' => BaseModel::TYPE_INT   ],
        'fertilizerAmount'      => ['type' => BaseModel::TYPE_ARRAY ]
    ];
}