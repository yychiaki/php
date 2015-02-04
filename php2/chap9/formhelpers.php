<?php
// 文字列のサニタイジングを行って返す
function h($str){
	return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

// テキストボックスを出力
function input_text($element_name, $values){
	print '<input type="text" name="' . $element_name . '" value="';
	print h($values[$element_name]) .'"/>';
}

// サブミットボタンを出力
function input_submit($element_name, $label){
	print '<input type="submit" name="' . $element_name . '" value="';
	print h($label) . '"/>';
}

// テキストエリアを出力
function input_textarea($element_name, $values){
	print '<textarea name="' . $element_name . '">';
	print h($values[$element_name]) . '</textarea>';
}

// ラジオボタンまたはチェックボックス出力
function input_radiocheck($type, $element_name, $values, $element_value){
	print '<input type="' . $type . '" name="' . $element_name . '" value="' . $element_value . '" ';
	if($element_value == $values[$element_name]){
		print ' checked="checked"';
	}
	print '/>';
}

// <select>メニューを出力
function input_select($element_name, $selected, $options, $mutiple = false){
	// <select>タグを出力
	print '<select name="' . $element_name;
	// 複数選択が許されていれば、複数アトリビュートを加え、
	// []をタグ名の最後に追加
	if($mutiple){ print '[]" multiple="multiple'; }
	print '">';

	// 選択されるもののリストを設定
	$selected_options = array();
	if($mutiple){
		foreach($selected[$element_name] as $val){
			$selected_options[$val] = true;
		}
	}else{
		$selected_options[$selected[$element_name]] = true;
	}

	// <option>タグを出力
	foreach($options as $option => $label){
		print '<option value="' . h($option) . '"';
		if(array_key_exists($option, $selected_options)){
			print ' selected="selected"';
		}
		print '>' . h($label) . '</option>';
	}
	print '</select>';
}
