<?php
$test = 'testtesttest!!!';
print 'We\'ll each have a bowl of soup.$test<br/>';//''singlコーテ-ションは変数を展開しない。
print "We'll each have a bowl of soup.$test<br/>";//''singlコーテ-ションは変数を展開する。

$price = 5;
$tax = 0.075;
printf('The dish costs $%.2f<br/>', $price * (1 + $tax));
print('The dish costs '. $price * (1 + $tax)) .'<br />';

$zip = '6520';
$month = 2;
$day = 6;
$year = 2007;
printf('ZIP is %05d and the date is %02d/%02d/%d<br />',$zip,$month,$day,$year );

$min = -40;
$max =40;
printf('The computer can operate between %+d and %+d degress Celsius.<br/>',$min,$max);

// mb_internal_encoding("UTF-8");
// mb_language("ja");
// setlocale(LC_ALL, "ja_JP.UTF-8")

$stra = 'abcde';
$strb = 'あいうえお';
echo strlen($stra). '<br/>';
echo strlen($strb). '<br/>';
echo mb_strlen($strb). '<br/>';