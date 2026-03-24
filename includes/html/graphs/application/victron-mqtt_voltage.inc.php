<?php

/**
 * victron-mqtt_voltage.inc.php
 *
 * Victron MQTT Voltage graph
 *
 * @link       https://www.librenms.org
 */

require 'includes/html/graphs/common.inc.php';

$rrd_filename = Rrd::name($device['hostname'], ['app', 'victron-mqtt', $app->app_id]);

$array = [
    'ac_in_l1_voltage' => ['descr' => 'AC Input', 'colour' => '22FF22'],
    'ac_out_l1_voltage' => ['descr' => 'AC Output', 'colour' => '0022FF'],
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

require 'includes/html/graphs/generic_multi_line.inc.php';
