<?php
$limit = 3;
try{
	$db = new PDO('sqlite:test.db');

	// $stmt = $db->query('SELECT * FROM dishes LIMIT'. $db->quote($limit));
	$sql = 'SELECT * FROM dishes WHERE price >= :min_price AND price <= :max_price';
	$stmt = $db->prepare($sql);
	$stmt-> execute(array(':min_price' => 3, 'max_price' => 5));

	$dishes = $stmt->fetchAll();
	foreach ($dishes as $dish) {
		print $dish['dish_id'] . ' ' . $dish['dish_name'] . ' ' . $dish['price'] . ' ' . $dish['is_spicy'] . "\n" . "<br>";
	}
}catch(PDOException $e){
	die('Cannot connet:' . $e->getMessage());
}