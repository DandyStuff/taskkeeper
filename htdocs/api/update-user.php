<?php

require "../../php/api.php";
require "../../php/start-session.php";

// Validation
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	bad_method();
}
check_session();
if (gettype($body) !== "object" || !property_exists($body, "old_password") || !property_exists($body, "email") || !property_exists($body, "first_name") || !property_exists($body, "last_name")) {
	bad_request();
}

require "../../php/mysql-connection.php";

$user_id = $_SESSION["user_id"];

$stmt = $mysqli->prepare("SELECT password_hash FROM users WHERE id=?;");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!password_verify($body->old_password, $user["password_hash"])) {
	echo '{"result":"wrong_password"}';
	exit;
} else {
	$stmt = $mysqli->prepare("UPDATE users SET email=?, first_name=?, last_name=? WHERE id=?;");
	$email = $body->email;
	$first_name = $body->first_name;
	$last_name = $body->last_name;
	$stmt->bind_param("sssi", $email, $first_name, $last_name, $user_id);
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
	
	if (property_exists($body, "new_password")) {
		$stmt = $mysqli->prepare("UPDATE users SET password_hash=? WHERE id=?;");
		$hash = password_hash($body->new_password, PASSWORD_DEFAULT);
		$stmt->bind_param("si", $hash, $user_id);
		$stmt->execute();
		$stmt->close();
	}

	echo '{"result":"ok"}';
}