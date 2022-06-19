#!/bin/sh
pkill -9 php

sleep 5

#start application
#php ../controller/sensorcontroller.php
exec php ../controller/sensorcontroller.php > /dev/null 2>&1 & echo $

