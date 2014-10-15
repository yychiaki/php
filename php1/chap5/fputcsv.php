<?php
//掲示板のコメントを保持するファイルを指定
$bbs_file = "bbs.csv";

//ファイルを追記モードで開く
$handle = fopen($bbs_file,"a");

// 書き込みたい情報を配列にまとめる
$csv[] = "ひよこ";
$csv[] = "ぴよぴよ";
$csv[] = time();

// ファイルに書き込みを行う
$result = fputcsv($handle,$csv);

// ファイルを閉じる
fclose($handle);

?>