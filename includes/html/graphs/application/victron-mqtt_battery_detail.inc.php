<?php

/**
 * victron-mqtt_battery_detail.inc.php
 *
 * Victron MQTT Battery Voltage/Current/Power graph
 *
 * @link       https://www.librenms.org
 */

require 'includes/html/graphs/common.inc.php';

$rrd_filename = Rrd::name($device['hostname'], ['app', 'victron-mqtt', $app->app_id]);

$ds = 'battery_voltage';
$colour_area = '22FF22';
$colour_line = '006600';
$colour_area_max = 'FFEE99';
$scale_min = 0;
$unit_text = 'Volts';

require 'includes/html/graphs/generic_simplex.inc.php';
