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

$years = array();
for($year = date('Y') -1, $max_year = date('Y') + 5; $year < $max_year; $year++) {
	$years[$year] = $year;
}

if(isset($_POST['_submit_check'])){
	if($form_errors = validate_form()){
		show_form($form_errors);
	} else {
		process_form();
	}
} else {
	show_form();
}
function show_form($errors = ''){
	if($errors){
		print 'You need to corret to following errors: <ul><li>';
		print implode('</li><li>', $errors);
		print '</li></ul>';
	}

print '<form method="POST" action="' . $_SERVER['PHP_SELF'] .'">';
print 'Expiration Date:';
input_select('month', $_POST, $GLOBALS['months']);
print ' ';
input_select('year', $_POST, $GLOBALS['years']);
print '<br />';
input_submit('submit', 'Check Expiration');

print '<input type="hidden" name="_submit_check" value="1"/>';
print '</form>';
}

	function validate_form(){
		$errors = array();

		//妥当な月と年が入力されたことを確かめる
		if(!array_key_exists($_POST['month'], $GLOBALS['months'])){
			$errors[] = 'Please select a valid month.';
		}
		if(!array_key_exists($_POST['year'], $GLOBALS['years'])){
			$errors[] = 'Please select avalid year.';
		}

		//月と年が現在の年月よりも後であることを確認する
		$this_month = date('n');
		$this_year = date('Y');

		if($_POST['year'] < $this_year){
			//入力された年が過去であれば、クレジットカードは執行している
			$errors[] = 'The credit card is expired.';
		} elseif(($_POST['year'] == $this_year) &&
			($_POST['month'] < $this_month)) {
				$errors[] = 'The credit card is expired.';
			}
		return $errors;
	}

function process_form(){
	print 'You entered a valid expiration date.';
}

