<?php
	require_once '../internal/tasks/service.php';

	$service = new TaskService();

	if (!isset($_POST["task_id"])) {
		header("Location: ../views/tasks.php?success=$flag");
		exit();
	}

	$flag = $service->make_task_done($_POST["task_id"]);
	header("Location: ../views/tasks.php?success=$flag");
	exit();
?>