<?php

namespace PNS;

class Fertilizer extends BaseModel {

    const TABLENAME = '`NUTRIENT`';

    protected $schema = [
        'ID'            => ['type' => BaseModel::TYPE_INT],
        'NAME'          => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 64],
        'SHORTTAG'      => ['type' => BaseModel::TYPE_STRING]
    ];
}