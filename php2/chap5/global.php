<?php
$dinner = 'Curry Cttlefish';

function vegetarian_dinner(){
	global $dinner;
	print "Dinner was $dinner, but now it's";
	$dinner = 'Sauteed Pea Shoots';
	print $dinner;
	print "<br/>\n";
}

print "Regular Dinner is $dinner. <br/>\n";
vegetarian_dinner();
print "Regular dinner is $dinner";