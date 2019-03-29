
<?php

include_once "message_database.php";
include_once "mode.php";
include_once "db.php";

//return_text_message(GOODMORNING);
//return_text_message(OUTGOING);
//return_text_message(COMEHOME);
//return_text_message(GOODNIGHT);
//return_text_message(REGISTERNAME, "111111");

function return_text_message($mode, $userId) {

	global $messages;

	$character = $messages[array_rand($messages, 1)];

	if($mode == REGISTERNAME) {
		$userName = GetUserNameFromDB($userId);
		$message_text = $userName . $character["rememberName"];
		var_dump($message_text);
		return $message_text;
	}

	$pattern = $character["Normal"][$mode][array_rand($character["Normal"][$mode], 1)];

	$array_count_text_segment = [
		count($pattern["text_segment1"]), 
		count($pattern["text_segment2"]), 
		count($pattern["text_segment3"]), 
	];

	$text_segment1 = $pattern["text_segment1"][rand() % $array_count_text_segment[0]];
	$text_segment2 = $pattern["text_segment2"][rand() % $array_count_text_segment[1]];
	$text_segment3 = $pattern["text_segment3"][rand() % $array_count_text_segment[2]];

	$message_text = $text_segment1 . $text_segment2 . $text_segment3;
	var_dump($message_text);
	
	return $message_text;

}
?>
