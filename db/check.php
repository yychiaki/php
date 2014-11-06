<?php

function check(){

	$errors = array();

	// 名前の入力チェック
	if(!isset($_POST["dname"])){
		$errors["dname"] = "部門名が入力されていません";
	}elseif (mb_strlen($_POST["dname"]) == 0) {
		$errors["dname"] = "部門名が入力されていません";
	}elseif (mb_strlen($_POST["dname"]) > 14) {
		$errors["dname"] = "部門名は14文字以内で入力してください";
	}

	// コメントの入力チェック
	if(!isset($_POST["loc"])){
		$errors["loc"] = "場所が入力されていません";
	}elseif (mb_strlen($_POST["loc"]) == 0) {
		$errors["loc"] = "場所が入力されていません";
	}elseif (mb_strlen($_POST["loc"]) > 10) {
		$errors["loc"] = "場所は10文字以内で入力してください";
	}
	return $errors;
}

?>
