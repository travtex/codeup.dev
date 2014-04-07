<?php

	$data = file_get_contents('parser-test.json');
	$json1 = json_decode($data);

function getName($val) {
	return trim(preg_replace("/[^A-Za-z ]/", '', $val));
}

function getZip($val) {
	$temp = explode(' ', $val);
	$zip = array_pop($temp);
	return substr($zip, 0, 5);
}

function getState($val) {
	$temp = explode(' ', $val);
	array_pop($temp);
	$state = array_pop($temp);
	return strtoupper($state);
}

function getStreet($val) {
	$temp = explode(' ', $val);
	array_pop($temp);
	array_pop($temp);
	$check = array_pop($temp);

	if ($check == 'antonio,') {
		array_pop($temp);
		$street = implode(' ', $temp);
	} else {

		$street = implode(' ', $temp);
	}
	return trim(preg_replace("/[^A-Za-z 0-9]/", '', $street));
}

function getCity($val) {
	$temp = explode(' ', $val);
	array_pop($temp);
	array_pop($temp);
	$city = preg_replace("/[^A-Za-z 0-9]/", '', array_pop($temp));

	if ($city !== 'antonio') {
		return ucfirst($city);
	} else {
		return "San " . ucfirst($city);
	}
}

	foreach($json1 as $entry) {
		$entry->name = getName($entry->name);
		$entry->state = getState($entry->address);
		$entry->zip = getZip($entry->address);
		$entry->city = getCity($entry->address);
		$entry->address = getStreet($entry->address);
	}



$fp = fopen('formatted_tester.json', 'w');
fwrite($fp, json_encode($json1));
fclose($fp);
