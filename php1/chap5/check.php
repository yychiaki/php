<?php

function check(){

	$errors = array();

	// 名前の入力チェック
	if(!isset($_POST["submit"])){
		$errors["name"] = "名前が入力されていません";
	}elseif (mb_strlen($_POST["name"]) == 0) {
		$errors["name"] = "名前が入力されていません";
	}elseif (mb_strlen($_POST["name"]) > 20) {
		$errors["name"] = "名前がは20文字以内で入力してください";
	}

	// コメントの入力チェック
	if(!isset($_POST["comment"])){
		$errors["comment"] = "コメントが入力されていません";
	}elseif (mb_strlen($_POST["comment"]) == 0) {
		$errors["comment"] = "コメントが入力されていません";
	}elseif (mb_strlen($_POST["comment"]) > 20) {
		$errors["comment"] = "コメントは400文字以内で入力してください";
	}
	return $errors;
}

?>
