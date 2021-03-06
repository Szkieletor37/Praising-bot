<?php
include_once "return_text_message.php";
include_once "mode.php";
include_once "db.php";
include_once "personal.php";
require '../vendor/autoload.php';

echo "Hello, Heroku!";

if (getenv('APP_ENV') == 'development') {
	// use phpdotenv
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
}
//heroku

if (getenv('APP_ENV') == 'production') {
	$accessToken = getenv('ACCESSTOKEN');
} else if (getenv('APP_ENV') == 'development') {
	// from .env
	$accessToken = getenv('ACCESSTOKEN_TEST');
}

$json_input = file_get_contents('php://input');
$json_object = json_decode($json_input);

$replyToken = $json_object->{"events"}[0]->{"replyToken"};
$input_message_type = $json_object->{"events"}[0]->{"message"}->{"type"};
$message_text = $json_object->{"events"}[0]->{"message"}->{"text"};
$userId = $json_object->{"events"}[0]->{"source"}->{"userId"};

createUserIfNotExist($userId);

if($input_message_type != "text")
	exit;

$reply_message_type = "text";

$checked_message_text = check_input_text($message_text);

switch ($checked_message_text) {
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
case "って呼んでね。":
	$mode = REGISTERNAME;
	RegisterNameToDB($userId, $message_text);
	break;
default:
	exit;
}

$return_message_text = return_text_message($mode, $userId);

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
