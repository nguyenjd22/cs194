<?php
session_start();
header("Content-Type: application/json"); 

try {
	$json_str = file_get_contents('php://input');
	$json_obj = json_decode($json_str, true);
	$username = $json_obj['username'];
	$password = $json_obj['password'];
;

	// Storing session data
	if (isset($_SESSION ['username'])) {
	} else {
		$_SESSION ['username'] = $username;
	}
	echo json_encode(array(
		"success" => true
	));
} catch (Exception $e) {
	echo json_encode(array(
		"Caught exception" => $e->getMessage()
	));
}

