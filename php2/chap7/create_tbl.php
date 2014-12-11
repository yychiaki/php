<?php
require_once 'MDB2.php';
define('USER_NAME','penguin');
define('USER_PASS','top^hat');
define('HOST_NAME','localhost');
define('DB_NAME','restaurant');

$dns = 'mysql://' . USER_NAME . ':' . USER_PASS .'@' . HOST_NAME . '/' . DB_NAME;
$db = MDB2::connect($dns);
if(MDB2::isError($db)){die("Can't connect:" . $db->getMessage());}

$sql = 'CREATE TABLE dishes(';
$sql .= 'dish_id Int primary key,';
$sql .= 'dish_name varchar(255),';
$sql .= 'price DECIMAL(4,2),';
$sql .= 'is_spicy INT';
$sql .= ')';

$q = $db->query($sql);
if(MDB2::isError($q)){die("query error:" . $q->getMessage());}

print 'CREATE TABLE OK!!!<br/>';