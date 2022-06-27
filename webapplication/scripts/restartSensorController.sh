#!/bin/sh
pkill -9 php

sleep 5

#start application
php ../controller/sensor_controller.php
