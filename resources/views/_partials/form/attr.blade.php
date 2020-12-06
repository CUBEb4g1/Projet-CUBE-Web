<?php
$str = '';

foreach ($attr as $key => $value) {
	$str .= ' ';
	if (is_numeric($key)) {
		$str .= $value;
	} elseif ($value === false) {
		$str .= $key . '=' . 'false';
	} elseif ($value === true) {
		$str .= $key . '=' . 'true';
	} else {
		$str .= $key . '="' . $value . '"';
	}
}

?>
{!!  $str !!}
