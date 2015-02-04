<?php
require 'formhelpers.php';
require_once 'MDB2.php';
define('USER_NAME','penguin');
define('USER_PASS','top^hat');
define('HOST_NAME','localhost');
define('DB_NAME','restaurant');

$dns = 'mysql://' . USER_NAME . ':' . USER_PASS .'@' . HOST_NAME . '/' . DB_NAME;
$db = MDB2::connect($dns);
if(MDB2::isError($db)){die("Can't connect:" . $db->getMessage());}

//この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);


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
	global $db;

	$errors = array();
	
	//ユーザ名でusersテーブルを検索
	$sth = $db->prepare('SELECT password FROM users WHERE username=?');
	$result = $sth->execute(array($_POST['username']));
	$encrypted_password = $result->fetchOne();

	//パスワードが正しいことを確かめる
	if($encrypted_password != crypt($_POST['password'], $encrypted_password)){
		$errors[] = 'Please enter a valid username and password.';
	}
	return $errors;
}

function process_form(){
	//ユーザー名をセッションに追加する
	$_SESSION['username'] = $_POST['username'];

	print "Welcome, $_SESSION[username]";
}

?>

