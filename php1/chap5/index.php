<?php
require_once("common.php");
require_once("check.php");

$errors = array();

// submitボタンが押されたら書き込む
if(isset($_POST["submit"])){
	// $_POST["submit"] = "";
	// フォームに入力された値のチェック
	$errors = check();

	// エラーがなければ書き込み処理に進む
	if(count($errors) == 0){
		$result = bbs_write($_POST);
		if(!$result){
			$errors["result"] = "書き込みに失敗しました";
		}
	}
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ひよこ掲示板</title>
	<style>
		p{
			padding: 5px;
			margin-left: 50px;
		}
		div.content {
			border-top: 1px dashed #555;
			margin-top: 10px;
		}
		ul.error{
			color:red;
		}
	</style>
</head>
<body>
	<h1>ひよこ掲示板</h1>
	<ul class="error">
		<?php 
		foreach($errors as $error){
			?>
			<li><?php print $error; ?></li>
			<?php }?>
		</ul>
		<form action="<?php print $_SERVER['SCRIPT_NAME'] ;?>" method="post">
			名前<br>
			<input type="text" name="name" value="" size="24"><br>
			コメント<br>
			<textarea name="comment" cols="40" rows="3"></textarea><br>
			<input type="submit" name="submit" value="書き込み">
		</form>
		<?php
		$records = bbs_read();
		$records = array_reverse($records);
		foreach($records as $key => $record){
			?>

			<div class="content">
				<span class="id"><?php print h($key + 1); ?></span>
				<span class="name">名前：<?php print h($record['name']); ?></span>
				<span class="time">
					<?php print date("Y年m月d日 H時i分s秒",intval($record['time'])) ;?>
				</span>
				<p class="comment"><?php print nl2br(h($record['comment'])); ?></p>
			</div>

			<?php
		}
		?>

	</body>
	</html>