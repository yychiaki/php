<?php
function page_header($title='my', $color='cc3399'){
	print '<html><head><meta charset="UTF-8"><title>Welcome to ';
	print $title;
	print ' site</title></head>';
	print '<body bgcolor ="#'. $color .'">';
}

function page_footer(){
	print '<hr/>Thanks for visiting.';
	print '</body></html>';
}

function restrant_check($meal, $tax, $tip){
	$tax_amount = $meal * ($tax / 100);
	$tip_amount = $meal * ($tip / 100);
	$total_amount = $meal + $tax_amount + $tip_amount;

	return $total_amount;
}

// page_header('yamauchi', '66cc66');
// page_header('yamauchi');>
page_header();

$user = 'yamauchi';
print "<p>Welcome, $user</p>";
// $total = restrant_check(1522,8.25,15);
// $total = floor($total);
// $total = number_format($total);


?>

あなたのトータル食事料金は「<?php 
//echo $total; 
echo number_format(floor(restrant_check(1522,8.25,15)));
?>」です。


<?php
page_footer();
?>