<?php
$sweets = array('シュークリーム',
	'ショートケーキ',
	'モンブラン',
	'チョコレートケーキ');
//フォームがサブミットされた時に何かをする
function process_form(){
	print"Hello," . $_POST['my_name'];
}

//フォームを表示
function show_form($errors = ''){
	if($errors){
		print "以下のエラーを修正してください:<ul><li>";
		print implode('</li><li>', $errors);
		print '</li></ul>';
	}

	?>

	<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
		<p>Your name: <input type="text" name="my_name"></p>
		<p>mail address: <input type="text" name="email"></p>
		<p>age: <input type="text" name="age" size="2"></p>
		<p>
			デザートを選択してください: <select name="order">
				<?php
				foreach($GLOBALS['sweets'] as $choice){
					print "<option>$choice</option>\n";
				}

				?>

			</select>
		</p>
		<input type="submit" value="Say Hello">
		<input type="hidden" name="_submit_check" value="1">
	</form>

	<?php } 

	function validate_form(){
		//エラーメッセージを格納する配列を初期化
		$errors = array();
		//名前が短すぎる場合のチェック
		if(mb_strlen($_POST['my_name']) < 3){
			$errors[] = '名前は3文字以上で入力して下さい';
		}
		//メールアドレスが入力されているかチェック
		if(strlen($_POST['email']) == 0){
			$errors[] = 'メールアドレスを入力してください';
		}elseif(!preg_match('/^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/i',$_POST['email'])){
			$errors[] = '正しいメールアドレスを入力してください';
		}
		//整数チェック
		if($_POST['age'] != strval(intval($_POST['age']))){
			$errors[] = '年齢は数値で入力してください';
		}elseif($_POST['age']<18 || $_POST['age'] > 65){
			$errors[] = '年齢は18歳以上65歳以下で入力してください';
		}
		return $errors;
	}
	?>
	<!DOCTYPE html>
	<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>フォームのひな形</title>
	</head>
	<body>

		<?php
		//サブミットされたフォームパラメータをベースに
		//なすべきことをするロジック
		if(array_key_exists('_submit_check',$_POST)){ //サブミットされた？
			if($form_errors = validate_form()){ //$_POSTのチェック
				show_form($form_errors); //フォームを再表示
			}else{
				process_form(); //処理を実行
			}
		}else {
			show_form(); //フォームを表示
		}
		?>

	</body>
	</html>