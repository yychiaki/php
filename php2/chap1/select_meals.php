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
if(MDB2::isError($db)){
	die('connection error:' . $db->getMessage());
}

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);



// print '接続成功！';

//許される食事は何かを定義する
$meals = array('breakfast'=>'朝食','lunch'=>'昼食','dinner'=>'夕食');


if(isset($_POST['submit'])){
//submitされたフォームパラメータの"meal"が、
//"breakfast", "lunch","dinner"のうち1つであることを確認する
	if(array_key_exists($_POST['meal'],$meals)){
		$unknown = false;
	// その場合、指定された食事のすべての料理を得る
		$sth = $db->prepare("SELECT dish, price FROM meals WHERE meal LIKE ?");
		$q = $sth->execute(array($_POST['meal']));
	}else{
		$unknown = true;
	}
}else{
	$unknown = false;
	$q = $db->query("SELECT dish, price FROM meals");
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>DB接続</title>
</head>
<body>
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
		<select name="meal">
			<?php foreach ($meals as $key => $value): ?>
				<?php if(isset($_POST['submit'])): ?>
					<option value="<?php echo $key; ?>" <?php echo $key == $_POST['meal'] ?'selected' : '' ?>>
						<?php echo $value; ?>
					</option>
				<?php else : ?>
					<option value="<?php echo $key; ?>">
						<?php echo $value; ?>
					</option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
		<input type="submit" value="検索" name='submit'>
	</form>
	<hr>
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