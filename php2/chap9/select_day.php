<?php
$midnight_day = mktime(0,0,0); //今日の0時0分0秒のエポックタイム
 print '<select name="date">';
for($i = 0; $i < 7; $i++) {
	//今日から$i日後のエポックタイム
	$timestamp = strtotime(" +$i day", $midnight_day);
	$display_date = strftime('%A %B %d, %Y', $timestamp);
	print '<option value="' .$timestamp . '">' . $display_date . "</option>\n";
}
print "\n</select>";

