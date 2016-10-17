<?php
$access_token = '78eGPEenScPLL3JYaUSj6R/4JFm+7sgqjvdDC1SH/RHM9Fq+Tj9rUO8xq5cpZbOvuNGKMuGAHiknSlcZcpdQkFodW4uw9vyvolDJtOqz+7vgUZBmDB0vVaMSoJV+/BiKj6doWPsCRN+onnYLk6uKngdB04t89/1O/w1cDnyilFU=';
// Get POST body content
//$content = file_get_contents('php://input');
// Parse JSON
//$events = json_decode($content, true);
	
	$messages = [
		'type' => 'text',
		'text' => 'ยิงๆๆๆๆๆ'
	];
	// Make a POST Request to Messaging API to reply to sender
	
	
	$url = 'https://api.line.me/v2/bot/message/push';
	
	$data = [
		"to" => ["dev2life"],
		'messages' => [$messages],
	];
	
	$post = json_encode($data);
	$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	echo $result . "\r\n";
	/* */
echo "OK";
