<?php
require_once 'formhelpers.php';

$hours = array();
for($hour = 1; $hour <= 12; $hour++){
	$hours[$hour] = $hour;
}

$minutes = array();
for($minute = 0; $minute < 60; $minute +=5){
	$formatted_minute = sprintf('%02d', $minute);
	$minutes[$formatted_minute] = $formatted_minute;
}

input_select('hour', $_POST, $hours);
print ':';
input_select('minute', $_POST, $minutes);
print ' ';
input_select('ampm', $_POST, array('am' => 'am', 'pm' => 'pm'));
