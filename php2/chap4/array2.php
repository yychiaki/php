<?php
/*
$dishes['Beef Chow Foon'] =12;
$dishes['Beef Chow Foon'] ++;
$dishes['Roast Duck'] =3;

$dishes['total'] = $dishes['Beef Chow Foon'] + $dishes['Roast Duck'];

var_dump($dishes);

if($dishes['total'] > 15){
	print "<p>You ate a lot:</p>";
}

$meals['breakfast'] = 'Wlnut Bum';
$meals['lunch'] = 'Eggplant with Chill Souce';
$amounts = array(1,2,3,4,5,6,);

var_dump($amounts);

unset($amounts[3]);

var_dump($amounts);

print "For breakfast, I'd like {$meals['breakfast']} and for lunch,";
print "I'd like {$meals['lunch']}. I want {$amounts[0]} at breakfast and";
print "{$amounts[1]} at lunch.";*/


//配列 -> 文字列変換
/*
$dimsum = array('Chicken Bun','Stuffed Duck Web', 'Turnip Cake');
$menu = implode('*---*',$dimsum);

print $menu;

print '<ul><li>'. implode('</li><li>',$dimsum). '</li></ul>';

print '<table border="1">';
print '<tr><td>' . implode('</td><td>', $dimsum) . '</td></tr>';
print '</table>';
*/

//区切りがある文字列 -> 配列変換
$fish = 'Bass, Carp, Pike, Flounder';
$fish_list = explode(',', $fish);
print "<p>The second fish is {$fish_list[1]}</p>";
var_dump($fish_list);
