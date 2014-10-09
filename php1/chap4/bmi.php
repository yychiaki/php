<?php

function bmi($height, $mass){
	$height = $height / 100;
	$mass = $mass /($height * $height);
	return $mass;
}

function h($str){
	return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

function validate_form(){
	$error = array();

	//身長
	if($_POST['height']!= strval(floatval($_POST['height']))){
		$error[] = "身長を正しく入力してください";
	}

		//体重
	if($_POST['mass']!= strval(floatval($_POST['mass']))){
		$error[] = "体重を正しく入力してください";
	}
	return $error;
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>BMI</title>
</head>
<body>
	<?php
	if(isset($_POST['submit'])){
		if($form_erros = validate_form()){
			//error message
			$error_text = '<tr><td>次のエラーを修正してください';
			$error_text .= '</td><ul><li>';
			$error_text .= implode('</li><li>',$form_erros);
			$error_text .= '</li></ul></td></tr>';
			echo $error_text;
		}else {
			$bmi = bmi($_POST['height'], $_POST['mass']);
			print "あなたのBMI値は" .round((h($bmi)),1) ."です";
			// 判定処理
			if($bmi < 18.5){
				print "<div style='color:blue'>やせ過ぎです</div>";
			}elseif($bmi > 25){
				print "<div style='color:red'>太り過ぎです</div>";
			}else{
				print "<div style='color:green'>標準です</div>";
			}
		}
	}else{
		print "BMI値を計算します";
	}


	?>

	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
		身長 <br>
		<input type="text" name="height"><br>
		体重 <br>
		<input type="text" name="mass"><br><br>
		<input type="submit" name="submit" value="send">



	</form>


</body>
</html>