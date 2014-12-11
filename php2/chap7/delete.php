<?php
require_once 'MDB2.php';
define('USER_NAME','penguin');
define('USER_PASS','top^hat');
define('HOST_NAME','localhost');
define('DB_NAME','restaurant');

$dns = 'mysql://' . USER_NAME . ':' . USER_PASS .'@' . HOST_NAME . '/' . DB_NAME;
$db = MDB2::connect($dns);
if(MDB2::isError($db)){die("Can't connect:" . $db->getMessage());}

//この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

$sql = 'DELETE FROM dishes';
$sql .= ' WHERE price >= 20';
$q = $db->query($sql);


print 'DELETE OK!!!<br/>';