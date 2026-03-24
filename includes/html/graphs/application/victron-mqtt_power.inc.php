<?php

/**
 * victron-mqtt_power.inc.php
 *
 * Victron MQTT Power Overview graph
 *
 * @link       https://www.librenms.org
 */

require 'includes/html/graphs/common.inc.php';

$rrd_filename = Rrd::name($device['hostname'], ['app', 'victron-mqtt', $app->app_id]);

$array = [
    'pv_power' => ['descr' => 'PV Power', 'colour' => 'FFA500'],
    'ac_out_l1_power' => ['descr' => 'AC Output', 'colour' => '22FF22'],
    'grid_l1_power' => ['descr' => 'Grid Power', 'colour' => '0022FF'],
    'battery_power' => ['descr' => 'Battery Power', 'colour' => 'FF0000'],
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

require 'includes/html/graphs/generic_multi_line.inc.php';
