<?php

namespace PNS;

class FertilizerAmount
{
    protected $fertilizerId;
    protected $amount;

    public function __construct($fertilizerId, $amount)
    {
        $this->fertilizerId = $fertilizerId;
        $this->amount = $amount;
    }

    public function fertilizerAmountJsonString()
    {

    }
}