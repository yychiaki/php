<?php
function select_random($array){
// 範囲を求めて$min/$max変数に記憶
	$min = 0;
	$max = count($array) -1;

// mt_rand()関数の結果を$key変数に記憶
	$key = mt_rand($min, $max);

	//結果を$result変数へ記憶
	$result = $array[$key];
	return $result;
	
}
