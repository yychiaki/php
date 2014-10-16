<?php
// 日本語の文字コード設定などを予め定義
mb_internal_encoding("UTF-8");
mb_language("ja");
setlocale(LC_ALL, "ja_JP.UTF-8");

// csvで利用するファイル名を指定
$bbs_file = "bbs.csv";

// エスケープを行うラッパ関数を定義
function h($str) {
	return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

// 掲示板のデータをファイルから読み込む関数を定義
function bbs_read(){
	global $bbs_file;

	//ファイルを読み込みモードで開く
	$handle = fopen($bbs_file,"r");

	//開いたポインタからデータを1行ずつ取得して配列に格納
	while($csv = fgetcsv($handle)){
		$record["name"] = $csv[0];
		$record["comment"] = $csv[1];
		$record["time"] = $csv[2];
		$records[] = $record;
	}

	//ファイルを閉じる
	fclose($handle);

	// 関数の実行結果を返す
	return $records;

}

// 掲示板のデータファイルに書き込む関数を定義
function bbs_write($data){
	global $bbs_file;

	//ファイルを追記モードで開く
	$handle = fopen($bbs_file,"a");

	// コメントの改行コードを統一する
	$data['comment'] = str_replace(array("/r/n","/n","/r"), PHP_EOL, $data['comment']);

	// 書き込みたい情報を配列にまとめる
	$csv[] = $data["name"];
	$csv[] = $data["comment"];
	$csv[] = time();

	// ファイルに書き込みを行う
	$result = fputcsv($handle,$csv);

	// ファイルを閉じる
	fclose($handle);

	// 関数の実行結果を返す
	return $result;
}