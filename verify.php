<?php
$access_token = '78eGPEenScPLL3JYaUSj6R/4JFm+7sgqjvdDC1SH/RHM9Fq+Tj9rUO8xq5cpZbOvuNGKMuGAHiknSlcZcpdQkFodW4uw9vyvolDJtOqz+7vgUZBmDB0vVaMSoJV+/BiKj6doWPsCRN+onnYLk6uKngdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
