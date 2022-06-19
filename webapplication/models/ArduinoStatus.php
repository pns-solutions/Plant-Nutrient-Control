<?php

namespace PNS;

class ArduinoStatus
{
    protected $time;
    protected $status;

    public function __construct($time, $status) {
        $this->time = $time;
        $this->status = $status;
    }
}