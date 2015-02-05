<?php
require_once 'formhelpers.php';

$months = array(1 => 'January',
	2 => 'Feburuary',
	3 => 'March',
	4 => 'April',
	5 => 'May',
	6 => 'June',
	7 => 'July',
	8 => 'August',
	9 => 'September',
	10 => 'October',
	11 => 'November',
	12 => 'December');

$years = array();
for($year = date('Y') -1, $max_year = date('Y') + 5; $year < $max_year; $year++) {
	$years[$year] = $year;
}

if(isset($_POST['_submit_check'])){
	//validate_form()がエラーを返した場合は、それをshow_form()へ渡す
	if($form_errors = validate_form()){
		show_form($form_errors);
	}else{
		//サブミットされたデータが妥当であれば、それを処理する
	show_form();
	process_form();
	}
}else{
	//サブミットされていないときは、フォームを表示して、
	//そして、その月のカレンダを表示
	show_form();
	show_calendar(date('n'),date('Y'));
}
function validate_form(){
	global $months, $years;

	$errors = array();
	if(!array_key_exists($_POST['month'],$months)){
		$errors[] = 'Select a valid month.';
	}
	if(!array_key_exists($_POST['year'],$years)){
		$errors[] = 'Select a valid year.';
	}
	return $errors;
}

function show_form($errors = ''){
	global $months, $years;

	//フォームがサブミットされたらデフォルトをサブミットされた変数から取得
	if(isset($_POST['_submit_check'])){
		$defaults = $_POST;
	} else {
		//それ以外は、独自のデフォルトを設定する：現在の月と年
		$defaults = array('year' => date('Y'),
			'month' => date('n'));
	}

	if($errors) {
		print 'Your need to correct the following errors:<ul><li>';
		print implode('</li><li>');
		print '</li></ul>';
	}

	print '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '">';
	input_select('month', $defaults, $months);
	input_select('year', $defaults, $years);
	input_submit('submit', 'Show Calendar');
	print '<input type="hidden" name="_submit_check" value="1"/>';
	print '</form>';
}

function process_form(){
	show_calendar($_POST['month'], $_POST['year']);
}

function show_calendar($month, $year){
	global $months;
	$weekdays = array('Su','Mo','Tu','We','Th','Fr','Sa');

	//その月の初日の真夜中のためのエポックタイムスタンプを見つける
	$first_day = mktime(0,0,0,$month,1,$year);
	$birthday= mktime(0,0,0, 6,15,$year);

	//その月の何日にあるか？
	$day_in_month = date('t',$first_day);

	$last_day = mktime(0,0,0, $month, $day_in_month, $year);

	if($first_day <= $birthday && $last_day >= $birthday){
	$birthday_flg = true;
	}else{
	$birthday_flg = false;
	}
	//その週の何番目の日(数値的に)がその月の初日となるか？
	//最初のテーブルセルを正しい場所に置くために必要
	$day_offset = date('w', $first_day);

	//表の見出しと曜日名の行を出力
	print <<<_HTML_
		<table border="0" cellspacing="0" cellpadding="2">
		<tr><th colspan="7">$months[$month] $year</th></tr>
		<tr><td align="center">
_HTML_;
print implode('</td><td align="center">',$weekdays);
print '</td></tr>';

//その月の初日が、ここでは、火曜日とすると、
//最初の行の’Su’と’Mo’の下のセルはブランクにして、
//1日のテーブルセルが’Tu’の下に来る
if($day_offset > 0){
	for($i =0; $i < $day_offset; $i++){
		print '<td>&nbsp;</td>';
	}
}

//その月のそれぞれの日のためのテーブルセルが出力される
for($day = 1; $day <= $day_in_month; $day++){
	if($day_offset == 0){
	print '<td align="center" style="color:red">' .$day .'</td>';
	}elseif($day_offset == 6){
	print '<td align="center" style="color:blue">' .$day .'</td>';
	}elseif($birthday_flg == true && $day == 15){
		print '<td align="center" style="color:pink">' .$day .'</td>';
	}else{
	print '<td align="center">' .$day .'</td>';
	}
	$day_offset++;
	//このセルが行の7番目であれば、テーブル行の終わり
	//となるので、$day_offsetをリセット
	if($day_offset == 7){
		$day_offset = 0;
		print "</tr>\n";
		//まだ日があれば、新しいテーブル行を開始
		if($day < $day_in_month){
			print '<tr>';
		}
	}
}

//この辞典で、テーブルセルはその月の各日にちについて出力されている。
//その月の最後の日が土曜日でなければ、テーブルの最後の行に
//空白のセルをその行の終わりまで積める必要がある。
if($day_offset > 0){
	for($i = $day_offset; $i < 7; $i++){
		print '<td>&nbsp;</td>';
	}
	print '</tr>';
}
print '</table>';
}
?>



