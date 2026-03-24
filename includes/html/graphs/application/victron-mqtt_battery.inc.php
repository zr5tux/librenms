<?php

/**
 * victron-mqtt_battery.inc.php
 *
 * Victron MQTT Battery SOC/SOH graph
 *
 * @link       https://www.librenms.org
 */

require 'includes/html/graphs/common.inc.php';

$rrd_filename = Rrd::name($device['hostname'], ['app', 'victron-mqtt', $app->app_id]);

$array = [
    'battery_soc' => ['descr' => 'State of Charge', 'colour' => '22FF22'],
    'battery_soh' => ['descr' => 'State of Health', 'colour' => '0022FF'],
];

$i = 0;
$rrd_list = [];

if (Rrd::checkRrdExists($rrd_filename)) {
    foreach ($array as $ds => $var) {
        $rrd_list[$i]['filename'] = $rrd_filename;
        $rrd_list[$i]['descr'] = $var['descr'];
        $rrd_list[$i]['ds'] = $ds;
        $rrd_list[$i]['colour'] = $var['colour'];
        $i++;
    }
} else {
    echo "file missing: $rrd_filename";
}

$colours = 'mixed';
$nototal = 1;
$unit_text = '%';
$scale_min = 0;
$scale_max = 100;

require 'includes/html/graphs/generic_multi_line.inc.php';
