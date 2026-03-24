<?php

/**
 * victron-mqtt_pv.inc.php
 *
 * Victron MQTT PV/Solar graph
 *
 * @link       https://www.librenms.org
 */

require 'includes/html/graphs/common.inc.php';

$rrd_filename = Rrd::name($device['hostname'], ['app', 'victron-mqtt', $app->app_id]);

$array = [
    'pv_power' => ['descr' => 'Total PV Power', 'colour' => 'FFA500'],
    'pv_string_0_power' => ['descr' => 'PV String 1', 'colour' => '22FF22'],
    'pv_string_1_power' => ['descr' => 'PV String 2', 'colour' => '0022FF'],
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
$unit_text = 'Watts';
$scale_min = 0;

require 'includes/html/graphs/generic_multi_line.inc.php';
