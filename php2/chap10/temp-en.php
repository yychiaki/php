<?php
//テンプレートファイルを読み込む
$page = file_get_contents('page-template.html');

//ページタイトルを挿入
$page = str_replace('{page_title}','Welcome', $page);

// ページの色を、午後は青、朝は緑にする
if(date('H') >= 12){
	$page = str_replace('{color}','blue', $page);
}else{
	$page = str_replace('{color}', 'green', $page);
}

//前回保存されたセッション変数からusernameを取り出す
$_SESSION['username'] = 'Jacob';
$page = str_replace('{name}', $_SESSION['username'], $page);

//結果を出力
print $page;
