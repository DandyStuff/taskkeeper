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

// Check if the task exists
$stmt = $mysqli->prepare("SELECT id FROM tasks WHERE id=?;");
$task_id = $body->id;
$stmt->bind_param("i", $task_id);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
	echo '{"result":"task_not_found"}';
	exit;
}
$stmt->close();

if (property_exists($body, "content")) {
	$stmt = $mysqli->prepare("UPDATE tasks SET content=? WHERE id=?;");
	$task_id = $body->id;
	$content = $body->content;
	$stmt->bind_param("si", $content, $task_id);
	$stmt->execute();
	$stmt->close();
}
if (property_exists($body, "completed")) {
	$stmt = $mysqli->prepare("UPDATE tasks SET completed=? WHERE id=?;");
	$task_id = $body->id;
	$completed = $body->completed;
	$stmt->bind_param("ii", $completed, $task_id);
	$stmt->execute();
	$stmt->close();
}

echo '{"result":"ok"}';
