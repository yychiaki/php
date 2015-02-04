<?php
//20016年11月1日のエポックタイムを取得
$november = mktime(0,0,0,11,1,2016);

// 2016年11月1日以降の最初の月曜日のエポックタイムを取得
$monday = strtotime('Monday', $november);
// 見つけた最初の月曜日の次の火曜日にスキップする
$election_day = strtotime('+1 day', $monday);

print strftime('Election day is %A, %B, %d, %Y,', $election_day);

