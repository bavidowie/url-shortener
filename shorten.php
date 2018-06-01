<?php

$mysqli = new mysqli('db_host', 'db_user', 'db_password', 'db_name');
if ($mysqli->connect_errno) {
    echo 'MySQL connection error: ' . $mysqli->connect_error;
}

$long_url = $_POST['long_url'];
if (preg_match('#\b(([\w-]+://?|www[.]|)[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#iS', $long_url)) {
    $mysqli->query("INSERT INTO alias (long_url) VALUES ('$long_url')");
	$short_url = base_convert($mysqli->insert_id, 10, 36);
    echo "Your short URL: <a target='_blank' href='/$short_url'>{$_SERVER['HTTP_HOST']}/$short_url</a>";
} else {
	echo 'Not a valid URL';
}