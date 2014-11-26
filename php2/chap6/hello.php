<?php
if(array_key_exists('my_name',$_POST)){
	print "Hello, " . $_POST['my_name'];

}else {
	$script_name = $_SERVER['SCRIPT_NAME'];
	print<<<_HTML_
	<form method="post" action="$script_name">
		Your name: <input type="text" name ="my_name">
		<br/>
		<input type="submit" lcg_value(oid)="Say Hello">
	</form>
_HTML_;

}