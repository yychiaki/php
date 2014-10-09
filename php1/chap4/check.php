<?php

// var_dump($_POST);

require_once('config.php');

function h($str){
	return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

if(!isset($_POST['submit'])){
	// $host = $_SERVER['SERVER_NAME'];
	// $url = $_SERVER['SCRIPT_NAME'];
	// $url = str_replace("check.php","form.php",$url);
	// header("location:http://{$host}{$url}");

	header("location:". FORM_URL);
}

$name = h($_POST['name']);
$password = h($_POST['password']);
$note = h(nl2br($_POST['note']));

$seibetu = array(1 =>"man", 2=>"woman", 9=>"no reply");
$sex = "unknown";
if(isset($_POST['sex'])){
	$sex = $seibetu[$_POST['sex']];
}

$live = array(1 =>"Hokkaido", 2 => "Aomori", 3 => "Iwate", 47 =>"Okinawa");
$living = "unknown";
if(isset($_POST['pref'])){
	$living = $live[$_POST['pref']];
}

$syumi = array(1=>"net",2=>"read books",3 => "shopping",4 => "cycling", 5 => "investment");
$hobbys[] = "unknown";
if(isset($_POST['hobby'])){
	$hobbys = array();
	foreach($_POST['hobby'] as $hobby){
		$hobbys[] = $syumi[$hobby];
	}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>input_check</title>
</head>
<body>
	<ul>
		<li>name:<?php echo $name; ?></li>
		<li>password:<?php echo $password; ?></li>
		<li>note:<br><?php echo $note; ?></li>
		<li>sex:<?php echo $sex; ?></li>
		<li>living:<?php echo $living; ?></li>
		<li>hobby: <br>
			<?php 
			$shumi_kaji = '<ul><li>';
			$shumi_kaji .= implode('</li><li>',$hobbys);
			$shumi_kaji .= '</ul></li>';
			echo $shumi_kaji; 
			?>
		</li>

	</ul>


	<p>
		<a href="form.php">return form</a>
	</p>
</body>
</html>