<?php
//formhelpers関数をインクルード
require_once 'formhelpers.php';
//show_form(),validate_form()及び、process_form()
//で、参照するので以下の配列はグローバル宣言する
$main_dishes = array('katsu' => 'カツ丼',
	'ten' => '天丼',
	'oya' => '親子丼',
	'tanin' => '他人丼',
	'soba' => '沖縄そば',
	'maku' => '幕の内');


$sweets = array('cue' => 'シュークリーム',
	'sho' => 'ショートケーキ',
	'mon' => 'モンブラン',
	'cho' => 'チョコレートケーキ');


if(isset($_POST['_submit_check']) && $_POST['_submit_check'] == 1){
	$defaults = $_POST;
}else{
	$defaults = array();
	$defaults['my_name'] = '';
	$defaults['email'] = '';
	$defaults['age'] = '';
	$defaults['order'] = 'cue';
	$defaults['main_dishes'] = array('katsu');

}

//フォームがサブミットされた時に何かをする
function process_form(){
	print"Hello," . $_POST['my_name'];
}

//フォームを表示
function show_form($errors = ''){
	global $defaults, $main_dishes;
	//なにかエラーが渡されると、それを出力
	if($errors){
		print "以下のエラーを修正してください:<ul><li>";
		print implode('</li><li>', $errors);
		print '</li></ul>';
	}
	?>

	<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
		<p>Your name: 
			<input type="text" name="my_name" value="<?php echo h($defaults['my_name']); ?>">
		</p>
		<p>mail address: 
			<input type="text" name="email" value="<?php echo h($defaults['email']); ?>">
		</p>
		<p>age: 
			<input type="text" name="age" size="2" value="<?php echo h($defaults['age']); ?>">
		</p>
		<p>料理を選択してください(複数選択可):</p>
		<p>
			<select name="main_dish[]" multiple="multiple">
				<?php
				$selected_options = array();
				foreach ($defaults['main_dish'] as $option) {
					$selected_options['option'] = true;
				}
				//<option>タグを出力
				foreach ($main_dishes as $option => $label) {
					print '<option value="' . h($option) . '"';
					if(array_key_exists($option, $selected_options)){
						print 'selected = "selected"';
					}
					print '>' . h($label) . '</option>';
					print "\n";
				} ?>
			</select>
		</p>

		<p>デザートを選択してください: 
			<select name="order">
				<?php
				foreach($GLOBALS['sweets'] as $key => $choice){
					print '<option value ="' . $key . '"';
					if($key == $defaults['order']){
						print 'selected = "selected"';
					}
					print ">$choice</option>\n";
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
		if(mb_strlen($_POST['mysql_db_name(result, row)']) < 3){
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
		//orderでの選択のチェック
		if(!array_key_exists($_POST['order'],$GLOBALS['sweets'])){
			$errors[] = 'メニューから選択してください';
		}
		//エラーメッセージの配列(エラーがなければ空)を返す
		return $errors;

	}
	// function h($str){
	// 	return htmlentities($str, ENT_QUOTES, 'UTF-8');
	// }
	?>
	<!DOCTYPE html>
	<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>フォームのひな形</title>
	</head>
	<body>

		<?php
		//メインページのロジック:
		//-フォームがサブミットされた場合は検証してしょり、
		//-サブミットされなかった場合はフォームを表示
		if(array_key_exists('_submit_check',$_POST)){
			//サブミットされたデータが正しければ、それを処理
			if($form_errors = validate_form()){
				show_form($form_errors); //フォームを再表示
			}else{
				process_form(); //処理を実行
			}
		}else {
			//サブミットされていなければフォームを表示
			show_form();
		}
		?>

	</body>
	</html>