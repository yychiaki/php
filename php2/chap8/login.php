<?php
require 'formhelpers.php';

//これは、formhelpers.phpのinput_text()関数と同じであるが、
//パスワードボックス(入力されたものを隠すアスタリスク)を出力する
function input_password($field_name, $values) {
	print '<input type="password" name="' . $field_name . '" value="';
	print htmlentities($values[$field_name]) . '">';
}

session_start();

if(isset($_POST['_submit_check'])) {
	if($form_errors = validate_form()){
		show_form($form_errors);
	} else {
		process_form();
	}
} else {
	show_form();
}

function show_form($errors = ''){
	print '<form method="POST" action"' .$_SERVER['PHP_SELF']. '">';
	
	if($errors){
		print '<ul><li>';
		print implode('</li><li>',$errors);
		print '</li></ul>';
	}
	if(!isset($_POST['_submit_check'])){
		$_POST['username'] ='';
		$_POST['password'] ='';
	}
	print 'Username: ';
	input_text('username', $_POST);
	print '<br/>';

	print 'Password: ';
	input_password('password',$_POST);
	print '<br/>';

	input_submit('submit', 'Log In');

	print '<input type="hidden" name="_submit_check" value="1" />';
	print '</form>';
}

function validate_form() {
	$errors = array();

	//いくつかのサンプルのユーザー名とパスワード
	$users= array('alice' => 'dog123',
			'bob' => 'my^pwd',
			'charlie' => '**fun**');

	//ユーザー名が妥当であることを確かめる
	if(! array_key_exists($_POST['username'], $users)) {
		$errors[] = 'Please enter a valid username and password.';
	} else{
		//パスワードが正しいことを確かめる
		$saved_password = $users[$_POST['username']];
		if($saved_password != $_POST['password']){
		$errors[] = 'Please enter a valid username and password.'; 
		}
	}
	return $errors;
}

function process_form(){
	//ユーザー名をセッションに追加する
	$_SESSION['username'] = $_POST['username'];

	print "Welcome, $_SESSION[username]";
}

?>

