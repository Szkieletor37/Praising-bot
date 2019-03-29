<?php

if(getenv('database_url')) {

	// Heroku postgres Add-on
	$url = parse_url(getenv('DATABASE_URL'));
	$host = $url['host'];
	$user = $url['user'];
	$pass = $url['pass'];
	$db = substr($url['path'], 1);
} else {

	// test
	$host = "localhost";
	$user = "szkieletor";
	$pass = "balabushka31";
	$db = "test";
}

//test

$con ="host=$host dbname=$db user=$user password=$pass";

function createUserIfNotExist($userId) {

	global $con;

	$link = pg_connect($con)
		or die ("Failed to connect to server\n");

	echo "hoge";

	$res1 = pg_query("INSERT INTO users(userid) SELECT '{$userId}' 
		WHERE NOT EXISTS (SELECT '{$userId}' FROM users WHERE userId = '{$userId}')");

	pg_close($link);
}


function RegisterNameToDB($userId, $message_text) {

	global $con;
	$userName = mb_substr($message_text, 0, -7, 'utf-8');

	$link = pg_connect($con)
		or die ("Failed to connect to server\n");

	pg_query("UPDATE users SET userName = '{$userName}' WHERE userId = '{$userId}'") 
		or die ("Failed to register username\n");

	pg_close($link);
}


function GetUserNameFromDB($userId) {

	global $con;

	$link = pg_connect($con)
		or die ("Failed to connect to server\n");

	$result = pg_query("SELECT userName FROM users WHERE userId = '{$userId}'") 
		or die ("Failed to find username\n");

	$userName = pg_fetch_result($result, 0, 'userName');

	pg_close($link);

	return $userName;
}
