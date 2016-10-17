<?php
$access_token = '78eGPEenScPLL3JYaUSj6R/4JFm+7sgqjvdDC1SH/RHM9Fq+Tj9rUO8xq5cpZbOvuNGKMuGAHiknSlcZcpdQkFodW4uw9vyvolDJtOqz+7vgUZBmDB0vVaMSoJV+/BiKj6doWPsCRN+onnYLk6uKngdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			
			/*
			if($text == 'ดัมเบิ้ลดอร์') $text = 'มีอะไรให้ข้ารับใช้ โปรดบอกข้ามา';
			elseif($text =='ดัม') $text = 'มีอะไรให้ข้ารับใช้ โปรดบอกข้ามา';
			elseif($text == '2ดอ') $text = 'มีอะไรให้ข้ารับใช้ โปรดบอกข้ามา';
			elseif($text == 'อับดุล') $text = 'มีอะไรให้ข้ารับใช้ โปรดบอกข้ามา';
			elseif($text == '1+1') $text = '2 ไง แค่นี้คิดไม่ได้หรอ เรียนจบมาได้ยังไงเนี๊ย';
			elseif($text == 'Check') $text = 'อยากรู้อะไร บอกข้ามา ตรวจสอบสถานะ Application พิมพ์ App ตรวจสอบการทำงานของ Database Job พิมพ์ Job';
			elseif($text == 'App') $text = 'Application ทำงานปกติ';
			elseif($text == 'Job') $text = 'Job ทำงานปกติ';
			elseif($text == 'Big') $text = 'หล่อสุดในสามโลก';
			else $text = '';
			*/
			
			$text = $response = file_get_contents('http://democlaimpa.rvp.co.th/Services/LineTest.ashx?text='+$text);
			if($text != '')
			{
				$messages = [
					'type' => 'text',
					'text' => $text
				];

				// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
					'replyToken' => $replyToken,
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
			}
		}
	}
}
echo "OK";


// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
