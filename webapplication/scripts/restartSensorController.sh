#!/bin/sh
pkill -9 php

sleep 30

#start application
php ../controller/sensor_controller.php
