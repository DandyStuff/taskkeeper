<?php

require "../../php/api.php";
require "../../php/start-session.php";

// Validation
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	bad_method();
}
check_session();
if (gettype($body) !== "object" || !property_exists($body, "id")) {
	bad_request();
}

require "../../php/mysql-connection.php";

$stmt = $mysqli->prepare("DELETE FROM tasks WHERE id=?;");
$task_id = $body->id;
$stmt->bind_param("i", $task_id);
$stmt->execute();
$stmt->close();

if ($stmt->affected_rows === 0) {
	echo '{"result":"task_not_found"}';
	exit;
}

echo '{"result":"ok"}';
