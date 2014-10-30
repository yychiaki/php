<?php
require_once 'MDB2.php';

$user = 'test';
$pass = '0987';
$dbname = 'testphp';

// データベースへの接続
$db = MDB2::connect("mysql://$user:$pass@localhost/$dbname");

// 失敗するとエラーメッセージを表示して終了
if(MDB2::isError($db)){
	die("Can't connect:" . $db->getMessage());
}

// ここまで来たら、接続成功
echo '接続成功<br>';

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

// 文字列キー付き配列にフェッチモードを変更
$db->setFetchMode(MDB2_FETCHMODE_ASSOC);

$rows = $db->queryAll('SELECT * FROM employees');
// foreach($rows as $row){
// 	var_dump($row);
// 	echo'<br>';
// }

?>

<!DOCTYPE html>
<html lang=ja>
<head>
	<meta charset="UTF-8">
	<title>データベース接続</title>
	<style>
		th,td{
			border: solid 1px;
			text-align: center;
			padding-right: 1em;
			padding-left: 1em;
		}

	</style>

</head>
<body>
	<table>
		<tr>
			<th>社員番号</th>
			<th>社員名</th>
			<th>ローマ字</th>
			<th>職種</th>
			<th>上司番号</th>
			<th>入社日</th>
			<th>給与</th>
			<th>歩合</th>
			<th>部門番号</th>
		</tr>

		<?php foreach($rows as $row){?>
		<tr>
			<td><?php echo $row['empno'] ?></td>
			<td><?php echo $row['ename'] ?></td>
			<td><?php echo $row['yomi'] ?></td>
			<td><?php echo $row['job'] ?></td>
			<td><?php echo $row['mgr'] ?></td>
			<td><?php echo $row['hiredate'] ?></td>
			<td><?php echo $row['sal'] ?></td>
			<td><?php echo $row['comm'] ?></td>
			<td><?php echo $row['deptno'] ?></td>
		</tr>
		<?php } ?>

	</table>
</body>
</html>