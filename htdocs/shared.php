<?php
require "../php/start-session.php";

// Validation
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
	http_response_code(405);
	exit;
}
if (!array_key_exists("id", $_GET)) {
	http_response_code(400);
	exit;
}

require "../php/mysql-connection.php";

$stmt = $mysqli->prepare("SELECT user_id, content, completed FROM tasks WHERE id=?;");
$task_id = $_GET["id"];
$stmt->bind_param("i", $task_id);
$stmt->execute();
$task = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($task !== null) {

	$stmt = $mysqli->prepare("SELECT first_name, last_name FROM users WHERE id=?;");
	$user_id = $task["user_id"];
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$user = $stmt->get_result()->fetch_assoc();
	$stmt->close();

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Shared task</title>

		<link rel="stylesheet" href="/assets/css/shared-style.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
		<!-- Navbar (sit on top) -->
		<div class="w3-top">
			<div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
				<a href="index" class="w3-bar-item w3-button">Task Keeper</a>
				<!-- Right-sided navbar -->
				<div class="w3-right w3-hide-small">
					<a href="index" class="w3-bar-item w3-button">Home Page</a>
					<a href="login" class="w3-bar-item w3-button">Login</a>
				</div>
			</div>
		</div>

		<!-- Header -->
		<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
			<img class="w3-image" src="/image/Tasks.png" width="1600" height="800">
			<div class="w3-display-center w3-padding-large w3-opacity">
				<div class="centered" style="font-size: 48px;">Task management tools for you!</div>
			</div>
		</header>

		<hr>

		<main>
			<div class="container">
				<h1><u>Shared Task</u></h1><br>
				<p id="result-box" style="display: none;"></p>

				<form id="form">
					<p><?php echo htmlspecialchars($user["first_name"] . ' ' . $user["last_name"]); ?> has shared a task with you:</p>
					<p><input type="text" disabled value="<?php echo htmlspecialchars($task["content"]); ?>"></p>
				</form>
			</div>
		</main>

		<hr>

		<!-- Footer -->

		<footer>
        <div class="container">
            <div class="information about">
                <h2>About Us</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tortor metus, commodo in rhoncus
                    accumsan, suscipit efficitur orci. Duis laoreet massa purus, suscipit lacinia urna maximus eu. Nam
                    commodo luctus luctus.</p>
                <ul class="social-icon">
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>

            <div class="information contact">
                <h2>Contact Us</h2>
                <ul class="info">
                    <li>
                        <span><i class="fa fa-map-marker"></i></span>
                        <span>Viện Nghiên cứu và Đào tạo Việt – Anh (VNUK)
                            <br>158A Lê Lợi, Hải Châu 1, Hải Châu, Đà Nẵng</span>
                    </li>
                    <li>
                        <span><i class="fa fa-phone"></i></span>
                        <p><a>+84 123 456 789</a>
                        </p>
                    </li>
                    <li>
                        <span><i class="fa fa-envelope"></i></span>
                        <p><a>quan.pham190208@vnuk.edu.vn</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

	</body>

	</html>
<?php

} else /* if ($task === null) */ {
	http_response_code(404);

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Unknown shared task</title>
		<link rel="stylesheet" href="/assets/css/main.css">
	</head>

	<body>
		<main>
			<h1>Unknown shared task</h1>
			<p>The task you are looking for doesn't exist. This probably happened because the owner deleted it.</p>
		</main>
	</body>

	</html>
<?php

}

?>