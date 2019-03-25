
<?php

include_once "database.php";

function mode_goodMorning() {

	global $messages;

	$character = array_rand($messages, 1);

	$array_count_text_segment = [
		count($messages[$character]["MORNING"]["text_segment1"]), 
		count($messages[$character]["MORNING"]["text_segment2"]), 
		count($messages[$character]["MORNING"]["text_segment3"]), 
	];

	$text_segment1 = $messages[$character]["MORNING"]["text_segment1"][rand() % $array_count_text_segment[0]];
	$text_segment2 = $messages[$character]["MORNING"]["text_segment2"][rand() % $array_count_text_segment[1]];
	$text_segment3 = $messages[$character]["MORNING"]["text_segment3"][rand() % $array_count_text_segment[2]];

	$message_text = $text_segment1 . $text_segment2 . $text_segment3;
	
	return $message_text;

}
?>
