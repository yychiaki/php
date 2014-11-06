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

//検索ボタンが押されたら検索
if(isset($_POST['submit'])){
	if(isset($_POST['key']) && mb_strlen($_POST['key']) > 0){
		$key = $_POST['key'];
	}else{
		$key = '';
	}
} else {
	$key = '';
}
// ここまで来たら、接続成功
echo '接続成功<br>';

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

// 文字列キー付き配列にフェッチモードを変更
$db->setFetchMode(MDB2_FETCHMODE_ASSOC);


$sql = 'select e.empno,e.ename,e.yomi,e.job,m.ename mgr,';
$sql .= 'e.hiredate, e.sal, e.comm, dname ';
$sql .= 'from employees e left outer join employees m on e.mgr = m.empno ';
$sql .= 'join departments d on e.deptno = d.deptno ';

//検索キーがあればプレースホルダを使う
if(mb_strlen($key) > 0){

	$key = '%' . $key .'%'; //部分一致をOKにする


	$sql .= 'where e.ename like ? order by e.empno';
	$sth = $db->prepare($sql);
	$result = $sth->execute(array($key));
	$rows = $result->fetchAll();

}else{
	$sql .= 'order by e.empno';
	$rows = $db->queryAll($sql);
}


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
		table {
			border: solid 1px;
			padding: 5px;
			border-radius: 5px;
		}
		th {
			background-color: black;
			color: white;
		}
		th,td{
			border: dotted 1px;
			text-align: center;
			padding-right: 1em;
			padding-left: 1em;
		}
		.right {
			text-align: right;
		}

	</style>

</head>
<body>

	<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post">
		<input type="text" name="key" size="10" />
		<input type="submit" name="submit" value="検索"  />

	</form>
	<hr />

	<?php 
	if(count($rows) > 0): 
		?>

	<table>
		<tr>
			<th>社員番号</th>
			<th>社員名</th>
			<th>ローマ字</th>
			<th>職種</th>
			<th>上司名</th>
			<th>入社日</th>
			<th>給与</th>
			<th>歩合</th>
			<th>部門名</th>
		</tr>

		<?php foreach($rows as $row){?>
		<tr>
			<td><?php echo $row['empno'] ?></td>
			<td><?php echo $row['ename'] ?></td>
			<td><?php echo $row['yomi'] ?></td>
			<td><?php echo $row['job'] ?></td>
			<td><?php echo $row['mgr'] ?></td>
			<td><?php echo $row['hiredate'] ?></td>
			<td><?php echo number_format($row['sal']) ?></td>
			<td class="right"><?php echo number_format($row['comm']) ?></td>
			<td><?php echo $row['dname'] ?></td>
		</tr>
		<?php } ?>
	</table>

<?php else : ?>

	<p>データないっす(ﾉд-｡)</p>

<?php endif; ?>

</body>
</html>