<?php
require "../php/start-session.php";

// Validation
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
	http_response_code(405);
	exit;
}
if (!array_key_exists("user_id", $_SESSION)) {
	http_response_code(302);
	header("Location: /login");
	exit;
}

require "../php/mysql-connection.php";

$stmt = $mysqli->prepare("SELECT id, content, completed FROM tasks WHERE user_id=?;");
$user_id = $_SESSION["user_id"];
$stmt->bind_param("i", $user_id);
$stmt->execute();
$tasks = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Your Tasks</title>

	<link rel="stylesheet" href="/assets/css/tasks-style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

	<script src="/assets/js/tasks.js" type="module"></script>

	<!-- Used by JS code to create new rows. This isn't part of the page. -->
	<template id="task-row-template">
		<tr>
			<td><input type="checkbox" class="task-checkbox"></td>
			<td><input type="text" class="task-input"></td>
			<td>
				<button class="task-edit-button" style="display: none;"><i class="fa fa-edit"></i> Edit</button>
				<button class="task-share-button" style="display: none;"><i class="fa fa-share-square"></i> Share</button>
				<button class="task-delete-button"><i class="fa fa-trash"></i> Delete</button>
				<button class="task-save-button"><i class="fa fa-save"></i> Save</button>
			</td>
		</tr>
	</template>
</head>

<body>
	<!-- Navbar (sit on top) -->
	<div class="w3-top">
		<div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
			<a href="#" class="w3-bar-item w3-button">Task Keeper</a>
			<!-- Right-sided navbar -->
			<div class="w3-right w3-hide-small">
				<a href="#" class="w3-bar-item w3-button">Tasks</a>
				<a href="profile" class="w3-bar-item w3-button">Profile</a>
				<a href="index" class="w3-bar-item w3-button">Logout</a>
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

	<!-- Your Tasks -->
	<main>
		<div class="container">
			<h1><u>Your Tasks</u></h1><br>
			<main>
				<table>
					<tbody id="tasks">
						<?php
						foreach ($tasks as $task) {
							echo '<tr data-task-id="' . $task["id"] . '"><td><input type="checkbox"' . ($task["completed"] ? " checked" : "") . '></td><td><input type="text" class="task-input" disabled value="' . htmlspecialchars($task["content"]) . '"></td><td><button class="task-edit-button"><i class="fa fa-edit"></i> Edit</button><button class="task-save-button" style="display: none;"><i class="fa fa-save"></i> Save</button><button class="task-share-button"><i class="fa fa-share-square"></i> Share</button><button class="task-delete-button"><i class="fa fa-trash"></i> Delete</button></td></tr>';
						}
						?>

					</tbody>
				</table>
				<button id="task-add-button"><i class="fa fa-plus-circle"></i> Create a task</button>
			</main>
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