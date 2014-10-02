<?php
//サイコロ1の結果
$saikoro = mt_rand(1,6);

// //サイコロ2の結果
$saikoro2 = mt_rand(1,6);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>サイコロ占い</title>
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
		}
		body{
			background-color:#ffffff;
			background-size:80px 80px;
			background-image:radial-gradient(#000,#000 15px,transparent 15px,transparent);
			position: relative;
			min-width: 800px;  /*中央配置するボックスの横幅*/
			min-height: 400px;  /*中央配置するボックス縦幅*/			
		}
		#saikoro_uranai {
			background-color: yellow;
			width: 800px;
			text-align: center;
			top: 50%;  /*上端を中央に*/
			left: 50%;  /*左端を中央に*/
			position: absolute;
			margin: -200px 0 0 -400px;  /*縦横の半分をネガティブマージンでずらす*/
			/*margin-right: auto;
			margin-left: auto;*/
			padding: 20px;
		}

	</style>
</head>
<body>
	<div id="saikoro_uranai">
		<h1>サイコロ占い</h1>
		<p>どうぞ、いらっしゃいまし〜サイコロの館へようこそ。ゾロ目がでると良いことあるかも！</p>



		<p>サイコロの目は「<?php print $saikoro; ?>」,「<?php print $saikoro2; ?>」です。</p>

		<?php

		if($saikoro == $saikoro2){
			print"でたヨ！ゾロ目！いいことあるかも";
		}else{
			print "";
		}
		?>
		<br/>
		<button onclick="location.reload()">もう一度</button>
	</div>


</body>
</html>