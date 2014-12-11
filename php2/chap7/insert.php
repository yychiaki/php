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


/*$sql = 'INSERT INTO dishes(dish_id, dish_name, price, is_spicy)';
$sql .= ' VALUES(4,"ステーキ", 20, 0)';
$q = $db->query($sql);

$sql = 'INSERT INTO dishes(dish_id, dish_name, price, is_spicy)';
$sql .= ' VALUES(5,"幕の内", 18, 0)';
$q = $db->query($sql);

$sql = 'INSERT INTO dishes(dish_id, dish_name, price, is_spicy)';
$sql .= ' VALUES(6,"ロブスターのチリソース", 15, 0)';
$q = $db->query($sql);
*/

$dish_id = $db->nextID('dishes');
$sql = 'INSERT INTO dishes(dish_id, dish_name, price, is_spicy)';
$sql .= ' VALUES(?,?,?,?)';
$sth = $db->prepare($sql);
$sth->execute(array($dish_id,"焼肉定食",22.15,0));

print 'INSERT OK!!!<br/>';