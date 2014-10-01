<?php
function sayHello($name){
	$aisatu = "こんにちは!{$name}さん";
	return "$aisatu";
}

function bmi($height, $mass){
	$height = $height / 100;
	$mass = $mass / ($height * $height);
	return $mass; //bmi
}
function process_form(){
	$bmi = bmi($_POST['height'],$_POST['mass']);


// $bmi = bmi(158,51);
	$bmi = round($bmi,1);


	print "BMI値は{$bmi}で、";


	if($bmi <18.5){
		echo"痩せすぎです";
	}else if ($bmi >25){
		echo"太り過ぎです";
	}else{
		echo"標準です";
	}
}

function show_form(){
	?>
	<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
		身長：
		<input type="text" name="height" ><br>
		体重：
		<input type="text" name="mass" ><br>
		<input type="submit" value="BMI計算値">
		<input type="hidden" name="_submit_check" value="1">
		</form
		<?php

	}
	?>
		<script>
			function home(){
				location.reload();
			}
		</script>
	<!DOCTYPE html>
	<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>関数の動作確認</title>
	</head>
	<body>

		<?php

		if(isset($_POST['_submit_check'])){
		process_form(); //BMI値測定

		//echo" <br><a href=" .$_SERVER['SCRIPT_NAME']. ">戻る</a>";


		echo "<br><button onclick='home()'>戻る</buttom>";
		

	}else{
		show_form(); //身長・体重入力フォーム

	} ?>

</body>
</html>