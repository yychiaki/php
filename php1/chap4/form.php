<?php


var_dump($_POST);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>form_lesson</title>
</head>
<body>
	<form action="check.php" method="post">
		name<br>
		<input type="text" name="name"><br>
		password<br>
		<input type="password" name="password"><br>
		notes<br>
		<textarea name="note" cols="40" rows="5">
		</textarea>
		<br>

		sex <br>
		<input type="radio" name="sex" value="1">man
		<input type="radio" name="sex" value="2">woman
		<input type="radio" name="sex" value="9">not reply
		<br>

		living <br>
		<select name="pref">
			<option value="1">Hokkaido</option>
			<option value="2">Aomori</option>
			<option value="3">Iwate</option>
			<option value="47">Okinawa</option>
		</select>
		<br>

		hobby <br>
		<input type="checkbox" name="hobby[]" value="1">net
		<input type="checkbox" name="hobby[]" value="2">read books
		<input type="checkbox" name="hobby[]" value="3">shopping
		<input type="checkbox" name="hobby[]" value="4">cycling
		<input type="checkbox" name="hobby[]" value="5">investment
		<br>
		<input type="submit" value="send">

	</form>
</body>
</html>