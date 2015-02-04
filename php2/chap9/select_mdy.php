<?php
require_once 'formhelpers.php';

$months = array(1 => 'January',
	2 => 'Feburuary',
	3 => 'March',
	4 => 'April',
	5 => 'May',
	6 => 'June',
	7 => 'July',
	8 => 'August',
	9 => 'September',
	10 => 'October',
	11 => 'November',
	12 => 'December');

$day = array();
for($i = 1; $i <= 31; $i++){
	$days[$i] = $i;
}

$years = array();
for($year = date('Y') -1, $max_year = date('Y') + 5; $year < $max_year; $year++) {
	$years[$year] = $year;
}

$_POST['month'] = '';
$_POST['day'] = '';
$_POST['year'] = '';
input_select('month', $_POST, $months);
print ' ';
input_select('day', $_POST, $days);
print ' ';
input_select('year', $_POST, $years);

