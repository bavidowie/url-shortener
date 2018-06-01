<?php

$mysqli = new mysqli('db_host', 'db_user', 'db_password', 'db_name');
if ($mysqli->connect_errno) {
    echo 'MySQL connection error: ' . $mysqli->connect_error;
}

$id = base_convert($_GET['url'], 36, 10);
$res = $mysqli->query("SELECT long_url FROM alias WHERE id='$id'");
if ($res->num_rows > 0) {
	$redirect = $res->fetch_assoc();
	if (preg_match('/^http:\/\//', $redirect['long_url'])) {
		header("Location:{$redirect['long_url']}");
	} else {
		header("Location:http://{$redirect['long_url']}");
	}
} else {
	echo 'No such url in database';
}