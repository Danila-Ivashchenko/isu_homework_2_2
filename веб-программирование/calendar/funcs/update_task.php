<?php
	require_once '../internal/tasks/service.php';

	if (!isset($_COOKIE["user_id"]) || !isset($_POST["theme"]) || !isset($_POST["date"])) {
		header("Location: ../views/tasks.php?success=false");
		exit();
	}
	$service = new TaskService();
	$data = ["task_id" => $_POST["task_id"], "type" => $_POST["type"], "theme" => $_POST["theme"], "location" => $_POST["location"], "date" => $_POST["date"], "time" => $_POST["time"], "duration" => $_POST["duration"], "comment" => $_POST["comment"]];

	$task_id = $_POST["task_id"];
	$flag = $service->update_task($data);
	header("Location: ../views/curent_task.php?success=$flag&task_id=$task_id");
	exit();
?>