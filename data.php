<?php
// login_ajax.php

header("Content-Type: application/json"); 
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);
$url = $json_obj['image_url'];
$file = 'imageurls.json';
$image_urls = file_get_contents($'imageurls.json');
$imageUrlArray = json_decode($image_urls);
array_push($imageUrlArray, $url);
$jsonData = json_encode($imageUrlArray);
file_put_contents('imageurls.json', $jsonData);
