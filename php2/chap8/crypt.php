<?php
//いくつかのサンプルのユーザー名とパスワード
$users= array('alice' => 'dog123',
		'bob' => 'my^pwd',
		'charlie' => '**fun**');

foreach($users as $user => $pass){
	echo "$user =>" . crypt($pass, '$1$456789012');
	echo '<br/>';
}
