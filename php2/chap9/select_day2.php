<?php
require_once 'formhelpers.php';

$midnight_day = mktime(0,0,0); //今日の0時0分0秒のエポックタイム
for($i = 0; $i < 7; $i++) {
	//今日から$i日後のエポックタイム
	$timestamp = strtotime(" +$i day", $midnight_day);
	$display_date = strftime('%A %B %d, %Y', $timestamp);
	$choices[$timestamp] =  $display_date;
}
$_POST['date'] = '';
input_select('date', $_POST, $choices);


