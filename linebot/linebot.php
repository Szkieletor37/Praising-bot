<?php
include_once "return_text_message.php";
include_once "mode.php";
 
echo "Hello, Heroku!";

//heroku
//$accessToken = 'mWbndsAPe5j0UvAvpkll+GfFdluug8RKZiLLta2cd3qNBiK/wF1OgA1ifzxFYZ8QwvaF3wJJCUL2Pvtfwxi3o+P+B7ImZt4dR6XZpY36/7Eai38V0jucNFH4U2Xhd1ZfZBcTfuqKeYmYGxOzFTdT0AdB04t89/1O/w1cDnyilFU=';
//test
$accessToken =  'y7LKpDt4OxHVS9qafyajq6bWlyc7H/rni0bXY65TIOZ0uJbRlflXub10GneSJebGUgjINXHXUasop6VJORPXtYAI8dsE1lDjlPdGgpNetRriWpB7xWc5Bwysq1ZIJ7i8dXggvFXCHP4WCxtw4TuXpwdB04t89/1O/w1cDnyilFU=';

$json_input = file_get_contents('php://input');
$json_object = json_decode($json_input);

$replyToken = $json_object->{"events"}[0]->{"replyToken"};
$input_message_type = $json_object->{"events"}[0]->{"message"}->{"type"};
$message_text = $json_object->{"events"}[0]->{"message"}->{"text"};
$user_id = $json_object->{"events"}[0]->{"source"}->{"userid"};

if($input_message_type != "text")
	exit;

$reply_message_type = "text";

switch ($message_text) {
case "おはよう！":
	$mode = GOODMORNING;
	break;
case "行ってきます！":
	$mode = OUTGOING;
	break;
case "ただいま！":
	$mode = COMEHOME;
	break;
case "おやすみ！":
	$mode = GOODNIGHT;
	break;
default:
	exit;
}

switch($mode) {
case GOODMORNING:
	$return_message_text = return_text_message($mode);
	break;
default:
	exit;
}

// insert usleep() to make bot's reply look real
$random = rand(400, 700); 
$sleeptime = $random / 100.0 * 1000000;
usleep($sleeptime);

sending_messages($accessToken, $replyToken, $reply_message_type, $return_message_text);
?>

<?php

function sending_messages($accessToken, $replyToken, $reply_message_type, $return_message_text) {

	$reply_messages = [
		"type" => $reply_message_type,
		"text" => $return_message_text
	];
	
	$post_data = [
		"replyToken" => $replyToken,
		"messages" => [$reply_messages]
	];

	$ch = curl_init("https://api.line.me/v2/bot/message/reply");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
	curl_setopt($ch, CURLOPT_HTTPHEADER,
		array(
			'Content-Type: application/json; charser=UTF-8',
			'Authorization: Bearer ' . $accessToken
		)
	);
	$result = curl_exec($ch);
	curl_close($ch); 
}
?>
