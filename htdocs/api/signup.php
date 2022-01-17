<?php

require "../../php/api.php";

// Validation
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	bad_method();
}
if (gettype($body) !== "object" || !property_exists($body, "email") || !property_exists($body, "password") || !property_exists($body, "first_name") || !property_exists($body, "last_name")) {
	bad_request();
}

require "../../php/mysql-connection.php";

$stmt = $mysqli->prepare("INSERT INTO users (email, password_hash, first_name, last_name) VALUES (?, ?, ?, ?);");
$email = $body->email;
$pasword_hash = password_hash($body->password, PASSWORD_DEFAULT);
$first_name = $body->first_name;
$last_name = $body->last_name;
$stmt->bind_param("ssss", $email, $pasword_hash, $first_name, $last_name);
try {
	$stmt->execute();
} catch (mysqli_sql_exception $e) {
	if ($mysqli->errno === 1062) {
		echo '{"result":"email_already_in_use"}';
		exit;
	} else {
		throw $e;
	}
} finally {
	$stmt->close();
}

require "../../php/start-session.php";
$_SESSION["user_id"] = (int) $mysqli->query("SELECT LAST_INSERT_ID();")->fetch_row()[0];
echo '{"result":"ok"}';
