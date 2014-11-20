<?php
$dinner = 'Curry Cttlefish';

function vegetarian_dinner(){
	//global $dinner;
	print "Dinner was {$GLOBALS['dinner']}, but now it's";
	$GLOBALS['dinner'] = 'Sauteed Pea Shoots';
	print $GLOBALS['dinner'];
	print "<br/>\n";
}

print "Regular Dinner is $dinner. <br/>\n";
vegetarian_dinner();
print "Regular dinner is $dinner";

//$GLOBALSはファイルページをまたいで変数を参照する