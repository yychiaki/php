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

//文字列キー付き配列にフェッチモードを変更
//$db->setFetchMode(MDB2_FETCHMODE_ASSOC);
$db->setFetchMode(MDB2_FETCHMODE_OBJECT);


$_POST['dish_serch'] = '焼肉定食';
$sql = 'SELECT dish_name,price FROM dishes WHERE dish_name LIKE ?';
$sth = $db->prepare($sql);
$result = $sth->execute(array($_POST['dish_serch']));
$matches = $result->fetchAll();
foreach($matches as $row){
	print "$row->dish_name, $row->price<br/>\n";
}


/*
$q = $db->query($sql);
while($row = $q->fetchRow()){
	//print "$row[0], $row[1]<br/>\n";
	//print "$row[dish_name], $row[price]<br/>\n";
	print "$row->dish_name, $row->price<br/>\n";
}
print 'dishesテーブルに' . $q->numrows() . '行の料理がありました<br/>';


$rows = $db->queryAll($sql);
foreach($rows as $row){
	print "$row[0], $row[1]<br/>\n";
}
*/

