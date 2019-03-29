<?php

function check_input_text($message_text) {

	// "call me ~" in Japanese.
	// if the end of the input is this, enter into REGISTERNAME mode.
	$str_call_me = "って呼んでね。";

	var_dump(mb_strlen($message_text, 'utf-8'));
	var_dump(mb_substr($message_text, 0, -7));
	var_dump(mb_substr($message_text, -7));
	// In order to prevent error for `mb_substr` below.
	if(mb_strlen($message_text, 'utf-8') <= 7) {
		return $message_text;
	}

	if(mb_substr($message_text, -7) == $str_call_me) {
		return $str_call_me;
	}

	// In other cases, return input
	return $message_text;
}

?>
