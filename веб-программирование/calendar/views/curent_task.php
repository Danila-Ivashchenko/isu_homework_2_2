<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/tasks.css?t=<?php echo(microtime(true).rand())?>">

	<title>Document</title>
</head>
<body>
	<?php
		require_once "../internal/tasks/service.php";
		$service = new TaskService();
		// print_r($_GET);
		$task = $service->get_task($_GET["task_id"]);
		if ($task == null) {
			header("Location: ../index.php");
			exit();
		}
		$data = $task->get_all_data();
	?>
	<div class="header">
	<div class="username">
		<?php
			echo $_COOKIE["user_name"];
		?>
	</div>
	<a href="tasks.php">Назад</a>
	</div>
	<div class="wrapper">
		<div class="section">
			<div class="status">
				<h3>
					<?php
						if (isset($_GET["success"])) {
							if ($_GET["success"] == 1) {
								echo "Успешно изменино";
							} else {
								echo "Ошибка";
							}
						}
					?>
				</h3>
			</div>

			<form class="dell_tasks" action="../funcs/delete_task.php" method="POST">
				<?php
					echo '<input type="hidden" name="task_id" value="' . $data[0] . '">';
				?>
				<button type="submit">Удалить</button>
			</form>

			<form class="add_tasks" action="../funcs/update_task.php" method="POST">

				<?php
				echo '<input type="hidden" name="task_id" value="' . $data[0] . '">';
				?>
				<div class="line">
					<label for="theme">Тема:</label>
					<?php
					echo '<input type="text" id="theme" name="theme" class="form-control" placeholder="Theme" value="' . $data[3] . '" required>'
					?>
				</div>
				<div class="line">
					<label for="type">Тип:</label>
					<select class="form-control" id="type" name="type">
						<?php
						echo '<option value="Встреча"' . (($data[2] == "Встреча") ? " selected " : " ") . '>Встреча</option>';
						echo '<option value="Звонок"' . (($data[2] == "Звонок") ? " selected " : " ") . '>Звонок</option>';
						echo '<option value="Совещание"' . (($data[2] == "Совещание") ? " selected " : " ") . '>Совещание</option>';
						echo '<option value="Дело"' . (($data[2] == "Дело") ? " selected " : " ") . '>Дело</option>';
						?>
					</select>
				</div>
				<div class="line">
					<label for="location">Место:</label>
					<?php
					echo '<input type="text" id="location" name="location" class="form-control" placeholder="Location" value="' .$data[4]. '">'
					?>
				</div>
				<div class="line">
					<label for="start_date">Дата начала:</label>
					<?php
						echo '<input type="date" id="start_date" name="date" class="form-control" value="' . $data[5] . '" required>'
					?>
				</div>
				<div class="line">
					<label for="start_date">Время начала:</label>
					<?php
						echo '<input type="time" id="start_time" name="time" class="form-control" value="' . $data[6] . '">'
					?>
				</div>
				<div class="line">
					<label for="duration">Продолжительность (в днях):</label>
					<?php
						echo '<input type="number" id="duration" name="duration" class="form-control" placeholder="Days" value="' . $data[7] . '">'
					?>
				</div>
				<div class="line">
					<label for="comment">Комментарий:</label><br>
					<?php
						echo '<textarea id="comment" name="comment" class="form-control" placeholder="Tell about your task">'. $data[9] . '</textarea>'
					?>
				</div>
				<div class="line">
					<button type="submit">Редактировать</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>