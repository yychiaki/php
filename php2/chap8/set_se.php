<?php
require_once 'formhelpers.php';

session_start();
$main_dishes = array('cuke' => 'Braised Sea Cucumber',
		'stomach' => 'Sauteed Pig Stomach',
		'tripe' => 'Sauteed Tripe with Wine Sauce',
		'giblets' => 'Baked Giblets with Salt',
		'abalone' => 'Abalone with Marrow and Duck Feet');

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
	print '<form method = "POST" action = "' . $_SERVER['PHP_SELF'] . '">';
	if($errors){
		print '<ul><li>';
		print implode('</li><li>', errors);
		print '</li></ul>';
	}

	print 'Dish: ';
	input_select('dish', $_POST, $GLOBALS['main_dishes']);
	print '<br/>';

	print 'Quantity: ';
	if(!isset($_POST['quantity'])){
		$_POST['quantity'] = '';
	}
	input_text('quantity', $_POST);
	print '<br/>';

	input_submit('submit', 'Order');

	print '<input type= "hidden" name = "_submit_check" value="1"/>';
	print '</form>';
}
function validate_form(){
	$errors = array();
	if(!array_key_exists($_POST['dish'],$GLOBALS['main_dishes'])){
		$errors[] = 'Please select a valid dish.';
	}

	if((!is_numeric($_POST['quantity'])) || (intval($_POST['quantity']) <= 0)){
		$errors[] = 'Please enter a quantity.';
	}
	return $errors;
}
function process_form(){
	$_SESSION['order'][] = array('dish' => $_POST['dish'],
			'quantity' => $_POST['quantity']);
	print 'Thank you for your order.';
} ?>
