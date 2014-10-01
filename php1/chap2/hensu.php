<?php
$suu = 10;
$moji = "あいうえお";
$fruit[] = "バナナ";
$fruit[] = "アップル";
$fruit[] = "メロン";

$member["name"] = "ひよこ";
$member["age"] = "3ヶ月";
$member["sex"] = "メス";
?>

変数$suuの内容：<?php echo $suu; ?><br/>
変数$mojiの内容：<?php echo $moji; ?><br/>

<?php
foreach($member as $key => $value){
	echo $key . ":" . $value . "<br />";
	// echo $f . "<br />"
}

var_dump($member);