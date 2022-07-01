<?php
$output = shell_exec('ps -C php -f');
if (strpos($output, "php ../controller/sensor_controller.php")===false) {
    shell_exec('php ../controller/sensor_controller.php  > /dev/null 2>&1 &');
}

if (strpos($output, "php ../controller/pump_valve_callback_controller.php")===false) {
    shell_exec('php .../controller/pump_valve_callback_controller.php  > /dev/null 2>&1 &');
}

