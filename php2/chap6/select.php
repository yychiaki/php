<?php
if(array_key_exists('category', $_POST)){
	?>

	Here are the submitted values: <br/><br/>

	product_id:<?php print $_POST['product_id']; ?><br/>
	category:<?php print $_POST['category']; ?>
	<p>Selected Buns:
		<br/>
		<?php
		foreach($_POST['lunch'] as $choice){
			print "You want a $choice bun.<br/>";
		} ?>
	</p>


	<?php 
}else {
	?>
	<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
		<input type="text" name="produbt_id">
		<br/>
		<select name="category" id="">
			<option value="ovenmitt">Pot Holder</option>
			<option value="fryingpan">Frying Pan</option>
			<option value="torch">Kitchen Torch</option>
		</select>
		<br/>

		<select name="lunch[]" multiple>
			<option value="pork">BBQ Pork Bun</option>
			<option value="chikin">Chicken Bun</option>
			<option value="lotus">Lotus Seed Bun</option>
			<option value="bean">Bean Paste Bun</option>
			<option value="nest">Bird-Nest Bun</option>
		</select>

		<input type="submit" name="submit">
	</form>

	<?php } ?>