<?php
session_start();
header("Content-Type: application/json"); 

try {
	$json_str = file_get_contents('php://input');
	$json_obj = json_decode($json_str, true);
	$url = $json_obj['image_url'];

	// Storing session data
	if (isset($_SESSION ['image_urls'])) {
		$urls = $_SESSION["image_urls"];
		array_push($urls, $url);
	} else {
		$_SESSION ['image_urls'] = [$url];
	}
	echo json_encode(array(
		"success" => true
	));
} catch (Exception $e) {
	echo json_encode(array(
		"Caught exception" => $e->getMessage()
	));
}

