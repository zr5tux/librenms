<?php

/**
 * victron-mqtt_cells.inc.php
 *
 * Victron MQTT Battery Cell Voltages graph
 *
 * @link       https://www.librenms.org
 */

require 'includes/html/graphs/common.inc.php';

$rrd_filename = Rrd::name($device['hostname'], ['app', 'victron-mqtt', $app->app_id]);

$array = [
    'bat_min_cell_v' => ['descr' => 'Min Cell Voltage', 'colour' => 'FF0000'],
    'bat_max_cell_v' => ['descr' => 'Max Cell Voltage', 'colour' => '22FF22'],
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
$unit_text = 'Volts';
$scale_min = 0;

require 'includes/html/graphs/generic_multi_line.inc.php';
