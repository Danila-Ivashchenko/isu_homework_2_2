<?php
	require_once '../internal/tasks/service.php';

	$flag = false;
	print_r($_POST);
	$date_time = new DateTime($_POST["date"]);
	if (!isset($_COOKIE["user_id"]) || !isset($_POST["theme"]) || !isset($_POST["date"])) {
		header("Location: ../views/tasks.php?success=$flag");
		exit();
	}
	$data = [$_COOKIE["user_id"], $_POST["type"], $_POST["theme"], $_POST["location"], $_POST["date"], $_POST["time"], $_POST["duration"] != "" ? $_POST["duration"] : 1, $_POST["comment"]];

	$servise = new TaskService();
	$flag = $servise->add_task($data);

	header("Location: ../views/tasks.php?success=$flag");
	exit();
?>