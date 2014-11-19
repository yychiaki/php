<?php
$firstname = 'kimiyuki';
$lastname = 'yama';
if(isset($firstname) && isset($lastname)){
	//if($firstname === 'kimiyuki' && $lastname == 'yamauchi'){
	if(($firstname === 'kimiyuki' && $lastname == 'yamauchi')){
		print 'Welcom abroad, trusted user.';
	}elseif($firstname == 'kimiyuki'){
		print 'Hello Kimiyuki!!!';
	}else {
		print 'Howdy, stranger';
	}
}else {
	print '$firstname is not exist.';
}

$age = 44;
//年齢($age)のチェック(15歳以上40歳未満) =>否定=> (15歳未満41歳以上)
if(!($age >= 15 && $age < 40)){
	print '<p>OKです</p>';
}else {
	print '<p>NGです</p>';
}