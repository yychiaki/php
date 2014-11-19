<?php
//$i = 1;
print '<select name = "people">';
//while($i <= 10){
for($i = 1,$j =10; $i <= 50; $i = $i +10, $j = $j+10){
	print "<option>$i-$j</option>";
	//$i++;
}
print '</select>';