<?php
// Definitions for API endpoints

function check_session() {
	if (!array_key_exists("user_id", $_SESSION)) {
		http_response_code(400);
		echo '{"result":"not_logged_in"}';
		exit;
	}
}
function bad_request() {
	http_response_code(400);
	echo '{"result":"bad_request"}';
	exit;
}
function bad_method() {
	http_response_code(405);
	echo '{"result":"method_not_allowed"}';
	exit;
}
function server_error() {
	http_response_code(500);
	echo '{"result":"internal_server_error"}';
	exit;
}
set_error_handler("server_error");

$body = json_decode(file_get_contents('php://input'));
if ($body === null) {
	bad_request();
}

header('Content-Type: application/json');
