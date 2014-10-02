<?php

//include("common.php");
require_once("common.php");


//結果配列を利用する
$uranai[] = "大吉ですおめでとうございます";
$uranai[] = "大吉です臨時収入があるかもしれません";
$uranai[] = "大吉です今日は楽しく過ごせるでしょう";
$uranai[] = "中吉です街に出かけるといいことがあるでしょう";
$uranai[] = "小吉です今日はまったり過ごしてみては";
$uranai[] = "末吉ですPHPの勉強をするといいことがあるでしょう";
$uranai[] = "大凶です今日は自宅でゆっくり過ごしてください";

// PHP動作確認
// var_dump($uranai);

?>



<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>おみくじ</title>
	<style type="text/css">
		body {
			background-color: #FFFFCC;
		}
		#uranai {
			width: 600px;
			text-align: center;
			background-color: yellow;
			margin-left: auto;
			margin-right: auto;
			padding: 60px;
			border-raddius: 6px;
		}

	</style>
</head>
<body>
	<div id="uranai">
		<h1>今日のあなたの運勢は？</h1>
		<p>「<?php print select_random($uranai); ?>」</p>

		<button onclick="location.reload()">もう一度</button>
	</div>


<!-- 	<p>あなたが引いたおみくじの結果は、「<?php print $uranai[$key]; ?>」です</p>
	<button onclick="location.reload()">もう一度</button> -->
</body>
</html>
