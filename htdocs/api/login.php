<?php

require "../../php/api.php";

// Validation
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	bad_method();
}
if (gettype($body) !== "object" || !property_exists($body, "email") || !property_exists($body, "password")) {
	bad_request();
}

require "../../php/mysql-connection.php";

$stmt = $mysqli->prepare("SELECT id, password_hash FROM users WHERE email=?;");
$email = $body->email;
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($user === null) {
	echo '{"result":"user_not_found"}';
} else if (!password_verify($body->password, $user["password_hash"])) {
	echo '{"result":"wrong_password"}';
} else {
	require "../../php/start-session.php";
	$_SESSION["user_id"] = $user["id"];
	echo '{"result":"ok"}';
}
