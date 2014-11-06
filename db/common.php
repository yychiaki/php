<?php
// 日本語の文字コード設定などを予め定義
mb_internal_encoding("UTF-8");
mb_language("ja");
setlocale(LC_ALL, "ja_JP.UTF-8");


// エスケープを行うラッパ関数を定義
function h($str) {
	return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

