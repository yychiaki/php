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


// フェッチモードを設定：行をオブジェクトとする
$db->setFetchMode(MDB2_FETCHMODE_OBJECT);

// フォームのメニューでの"辛い"の選択
$spicy_choice = array('no'=>'いいえ','yes'=>'はい','either'=>'両方');

function show_form($errors = ''){
	global $spicy_choice;
	//フォームがサブミットされたら、サブミットされた
	//パラメータからデフォルトを取り出す
	if(isset($_POST['_submit_check'])){
		$defaults = $_POST;
	}else{
		//そうでなければ、独自のデフォルトをセット:priceは$5
		$defaults = array(
			'dish_name' => ''
			,'min_price' => '5.00'
			,'max_price' => '25.00'
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
				<td>最低価格:</td>
				<td><?php input_text('min_price', $defaults) ?></td>
			</tr>
			<tr>
				<td>最高価格:</td>
				<td><?php input_text('max_price', $defaults) ?></td>
			</tr>
			<tr>
				<td>辛さ:</td>
				<td><?php input_select('is_spicy', $defaults, $spicy_choice); ?></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><?php input_submit('search','料理検索'); ?></td>
			</tr>
		</table>
		<input type="hidden" name="_submit_check" value="1" />
	</form>

	<?php
}//show_form()の終わり

function validate_form(){
	global $spicy_choice;

	$errors = array();

	//最低価格は妥当な浮動小数点数でなくてはならない
	if($_POST['min_price'] != strval(floatval($_POST['min_price'])) 
		|| floatval($_POST['min_price']) <= 0){
		$errors[] = '最低価格に正しい値を入力してください';
}
	//最高価格は妥当な浮動小数点数でなくてはならない
if($_POST['max_price'] != strval(floatval($_POST['max_price'])) 
	|| floatval($_POST['max_price']) <= 0){
	$errors[] = '最高価格に正しい値を入力してください';
}
	//最低価格は最高価格より低くなくてはならない
if($_POST['min_price'] >= $_POST['max_price']){
	$errors[] = '最低価格は最高価格より少ない値を入力してください';
}
if(!array_key_exists($_POST['is_spicy'], $spicy_choice)){
	$errors[] = '「辛い」を正しく選択してください';
}
return $errors;
}
function process_form(){
	//このファンクション内で、グローバル変数を$dbにアクセスする
	global $db, $is_spicy;

	//クエリを組み立てる
	$sql = 'SELECT dish_name, price, is_spicy FROM dishes WHERE';
	$sql .= ' price >= ? AND price <= ?';

	//料理名がサブミットされた場合は、WHERE句を加える
	// ユーザーが入れたワイルドカードを避けるために、quote()とstrtrを使う
	if(mb_strlen(trim($_POST['dish_name']))){
		$dish = $db->quote($_POST['dish_name']);
		$dish = strtr($dish, array('_' => '\_', '%' =>'\%'));
		$sql .= "AND dish_name LIKE $dish";
	}

	//is_spicyが"yes"あるいは"no"の場合は、適切なSQLを加える
	// "either"の場合は、is_spicyをWHEREに加える必要はない
	$is_spicy = $_POST['is_spicy'];
	if($is_spicy == 'yes'){
		$sql .= ' AND is_spicy = 1';
	}elseif($is_spicy == 'no'){
		$sql .= ' AND is_spicy = 0';
	}
	// クエリをデータベースプログラムに送り、戻ってくるすべての行を取得
	$sth = $db->prepare($sql);
	$result = $sth->execute(array($_POST['min_price'], $_POST['max_price']));
	$dishes = $result->fetchAll();

	if(count($dishes) == 0){
		print '料理はありませんでした';
	}else{
		print '<table>';
		print '<tr><th>料理名</th><th>価格</th><th>辛い？</th></tr>';
		foreach($dishes as $dish){
			if($dish->is_spicy == 1){
				$spicy = '辛い';
			}else{
				$spicy = '辛くない';
			}
			printf('<tr><td>%s</td><td>$%.02f</td><td>%s</td></tr>'
				,h($dish->dish_name), $dish->price, $spicy);
		}
		print '</table>';
	}
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