<!-- secrets.php is to keep our client_secret secure 
and unknown by those using the website -->

<?php
header("Content-Type: application/json"); 
$data = json_encode(
	array(
		'client_secret' => 'e5fdc19871c039920666210a6a900d31',
	)
);
echo $data;