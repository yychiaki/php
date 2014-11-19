<?php
/*
$vegetable['corn'] = 'yellow';
$vegetable['beet'] = 'red';
$vegetable['carrot'] = 'orange';
*/
$vegetable = array('corn' => 'yellow'
	,'beet' => 'red'
	,'carrot' => 'orange'
	);


var_dump($vegetable);

print '<br/><br/>';

/*
$dinner[] = 'Sweet Corn and Asparagus';
$dinner[] = 'Lemon Chiken';
$dinner[] = 'Brased Bamboo Fungus';
*/
$dinner = array('Sweet Corn and Asparagus',
	'Lemon Chiken',
	'Brased Bamboo Fungus'
	);
$row_color = array('red','green');
$color_index = 0;

print "<table border ='1'>\n";
foreach($dinner as $key => $value){
	print '<tr bgcolor="' .$row_color[$color_index] . '">';
	print "<td>$key</td><td>$value</td></tr>\n";
	$color_index = 1 - $color_index;
}

print "</table>\n";

$dishes = count($dinner);
//var_dump($dinner);

