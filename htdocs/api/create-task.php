<?php

require "../../php/api.php";
require "../../php/start-session.php";

// Validation
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	bad_method();
}
check_session();
if (gettype($body) !== "object" || !property_exists($body, "content") || !property_exists($body, "completed")) {
	bad_request();
}

require "../../php/mysql-connection.php";

while (true) {
	$stmt = $mysqli->prepare("INSERT INTO tasks (id, user_id, content, completed) VALUES (?, ?, ?, ?);");
	$task_id = random_int(0, 4294967295);
	$user_id = $_SESSION["user_id"];
	$content = $body->content;
	$completed = $body->completed;
	$stmt->bind_param("iisi", $task_id, $user_id, $content, $completed);

	// In the rare case that there is already a task with the same ID
	try {
		$stmt->execute();
		break;
	} catch (mysqli_sql_exception $e) {
		if ($mysqli->errno === 1062) {
			continue;
		} else {
			throw $e;
		}
	} finally {
		$stmt->close();
	}
}

echo '{"result":"ok","id":'.$task_id.'}';
