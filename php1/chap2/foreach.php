<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>foreach動作確認</title>
</head>
<body>
	<?php
	$member["name"] = "Hiyoko";
	$member["age"] = "3month";
	$member["sex"] = "female";

	foreach($member as $key => $value){
		print $key ."は" . $value . "です。<br>";
	}
?>
</body>
</html>
