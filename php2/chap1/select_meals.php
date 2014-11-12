<?php
require_once 'MDB2.php';
//ユーザー名'menu'とパスワード'good2eaT'を用いて、ローカルホスト上で走る
//MySQLのデータベース'dinner'に接続する

define('HOST_NAME', 'localhost');
define('USER_NAME', 'menu');
define('USER_PASS', 'good2eaT');
define('DB_NAME', 'dinner');

$dns = 'mysql://' . USER_NAME . ':' . USER_PASS . '@' . HOST_NAME . '/' . DB_NAME;
$db = MDB2::connect($dns);
if(MDB2::isError($db)){die('connection error:' . $db->getMessage());}

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);


// print '接続成功！';

//許される食事は何かを定義する
$meals = array('breakfast','lunch','dinner');

//submitされたフォームパラメータの"meal"が、
//"breakfast", "lunch","dinner"のうち1つであることを確認する
if(in_array($_GET['meal'],$meals)){
	$unknown = false;
	// その場合、指定された食事のすべての料理を得る
	$q = $db->query("SELECT dish, price FROM meals WHERE meal LIKE '" . $_GET['meal'] ."'");
}else{
	$unknown = true;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>DB接続</title>
</head>
<body>
	<?php if($unknown == true || $q->numrows() == 0): ?>
		<p>no dishes available.</p>
	<?php else: ?>
		<table border='1'>
			<tr>
				<th>料理名</th>
				<th>価格</th>
			</tr>
			<?php while($row = $q->fetchRow()): ?>
				<tr>
					<td><?php echo $row[0]; ?></td>
					<td><?php echo $row[1]; ?></td>
				</tr>
			<?php endwhile; ?>
		</table>
	<?php endif; ?>

</body>
</html>