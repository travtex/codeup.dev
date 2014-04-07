<?php

$data = file_get_contents('formatted_tester.json');
$json1 = json_decode($data);

// var_dump($json1[0]);

	$client_address = $json1[1]->address;
    $client_city = $json1[1]->city;
    $client_state = $json1[1]->state;
    $client_zip = $json1[1]->zip;

// building the JSON URL string for Google API call 
    $g_address = str_replace(' ', '+', trim($client_address)).",";
    $g_city    = '+'.str_replace(' ', '+', trim($client_city)).",";
    $g_state   = '+'.str_replace(' ', '+', trim($client_state));
    $g_zip     = isset($client_zip)? '+'.str_replace(' ', '', trim($client_zip)) : '';

$g_addr_str = $g_address.$g_city.$g_state.$g_zip;       
$url = "https://maps.google.com/maps/api/geocode/json?
        address=$g_addr_str&sensor=false&key=AIzaSyB5pN589kJ9atcmTc_unoGVFl-abNJFdV8";

    var_dump($url);

    $jsonData   = file_get_contents($url);

$data = json_decode($jsonData);

$xlat = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
$xlong = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

echo $xlat.",".$xlong;