<?php
require_once 'MDB2.php';

//フォームヘルパー関数をロード
require_once 'formhelpers.php';

define('USER_NAME','penguin');
define('USER_PASS','top^hat');
define('HOST_NAME','localhost');
define('DB_NAME','restaurant');

$dns = 'mysql://' . USER_NAME . ':' . USER_PASS .'@' . HOST_NAME . '/' . DB_NAME;
$db = MDB2::connect($dns);
if(MDB2::isError($db)){die("Can't connect:" . $db->getMessage());}

//この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

function show_form($errors = ''){
	//フォームがサブミットされたら、サブミットされた
	//パラメータからデフォルトを取り出す
	if(isset($_POST['_submit_check'])){
		if(!isset($_POST['is_spicy'])){ //辛いのチェックがついてなければ
			$_POST['is_spicy'] = 'no';
		}
		$defaults = $_POST;
	}else{
		//そうでなければ、独自のデフォルトをセット:priceは$5
		$defaults = array(
			'dish_name' => ''
			,'price' => '5.00'
			,'is_spicy' => 'no'
			);
	}

	//エラーが渡されると、$error_textに入れる(HTMLマークアップとともに)
	if(is_array($errors)){
		$error_text = '<tr><td>右記のエラーを修正してください:';
		$error_text .= '</td><td><ul><li>';
		$error_text .= implode('</li><li>', $errors);
		$error_text .= '</li></ul></td></tr>';
	}else{
		//エラーがないなら$error_textはブランク
		$error_text = '';
	}
	//一旦PHPを抜ける
	?>

	<form method="POST" action="<?php print $_SERVER['PHP_SELF']; ?>">
		<?php print $error_text ?>
		<table>
			<tr>
				<td>料理名：</td>
				<td><?php input_text('dish_name', $defaults) ?></td>
			</tr>
			<tr>
				<td>価格:</td>
				<td><?php input_text('price', $defaults) ?></td>
			</tr>
			<tr>
				<td>辛さ:</td>
				<td><?php input_radiocheck('checkbox','is_spicy', $defaults, 'yes'); ?>はい</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><?php input_submit('save','追加'); ?></td>
			</tr>
		</table>
		<input type="hidden" name="_submit_check" value="1" />
	</form>

	<?php
}//show_form()の終わり
function validate_form(){
	$errors = array();

	//dish_nameが要求される
	if(!mb_strlen(trim($_POST['dish_name']))){
		$errors[] = '料理名を入力してください';
	}

	//priceは妥当な小数点数で0より大きくなければならない
	if($_POST['price'] != strval(floatval($_POST['price'])) 
		|| floatval($_POST['price']) <= 0){
		$errors[] = '価格に正しい値を入力してください';
	}
	return $errors;
}
function process_form(){
	//このファンクション内で、グローバル変数を$dbにアクセスする
	global $db;

	//この料理のために一意なIDを取得
	$dish_id = $db->nextID('dishes');

	//$is_spicyの値をチェックボックスの値をもとに設定
	if(isset($_POST['is_spicy']) && $_POST['is_spicy'] == 'yes'){
		$is_spicy = 1;
	}else {
		$is_spicy - 0;
	}

	//新しい料理をテーブルに挿入
	$sql = 'INSERT INTO dishes(dish_id, dish_name, price, is_spicy)';
	$sql .= 'VALUES(?,?,?,?)';
	$sth = $db->prepare($sql);
	$sth->execute(
		array($dish_id, $_POST['dish_name'], $_POST['price'], $is_spicy)
		);

	//料理を追加したことをユーザーに伝える
	print '「' . h($_POST['dish_name']) . '」をデータベースに追加しました';

	//一度書き込んだあと、ブラウザのreloadで、同じデータが書き込まれてしまう問題を修正
	header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);
	exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>メニューに料理を追加</title>
</head>
<body>
	<?php
//メインページのロジック：
//-フォームがサブミットされたら、検証してから処理、あるいは表示
//-サブミットされなければ表示
	if(isset($_POST['_submit_check'])){
	//validate_form()がエラーを返したら、それをshow_form()へ返す
		if($form_errors = validate_form()){
			show_form($form_errors);
		}else {
		//サブミットされた値が妥当であれば、それを処理
			process_form();
		}
	}else {
	//フォームがサブミットされなければ表示
		show_form();
	}
	?>

</body>
</html>