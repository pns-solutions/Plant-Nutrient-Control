#!/bin/sh
pkill -9 php

sleep 20

#start application
php sensorcontroller.php
