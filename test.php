<?php

$f= array("Sunday", "Monday","Tuesday","Wednesday", "Thursday","Friday", "Saturday");
foreach ($f as $value) {
	if($value = date('l')){
		$date[] = $value;
	}
}
$date = array_values($date);
print_r($date);