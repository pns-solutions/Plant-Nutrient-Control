<?php

namespace PNS;

class SolverResult
{
    protected $time;
    protected $tableId;
    protected $fertilizerAmount;

    public function __construct($time, $tabledId, $fertilizerAmount)
    {
        $this->time = $time;
        $this->tabledId = $tabledId;
        $this->fertilizerAmount = $fertilizerAmount;
    }

    public function solverResultJsonString()
    {

    }
}