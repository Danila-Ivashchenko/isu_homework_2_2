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
		if (!isset($_COOKIE["user_id"])) {
			header("Location: ./views/login.php");
			exit();
		}
		require_once "../internal/tasks/service.php";
	?>
	<div class="header">
		<div class="username">
			<?php
				echo $_COOKIE["user_name"];
			?>
		</div>
		<a href="dislogin.php">Выйти</a>
	</div>
	<div class="wrapper">
		<form class="add_tasks" action="../funcs/add_task.php" method="POST">
			<div class="line">
				<label for="theme">Тема:</label>
				<input type="text" id="theme" name="theme" class="form-control" placeholder="Theme" required>
			</div>
			<div class="line">
				<label for="type">Тип:</label>
				<select class="form-control" id="type" name="type">
					<!-- <option value="meeting">Встреча</option> -->
					<option value="Встреча">Встреча</option>
					<option value="Звонок">Звонок</option>
					<option value="Совещание">Совещание</option>
					<option value="Дело">Дело</option>
				</select>
			</div>
			<div class="line">
				<label for="location">Место:</label>
				<input type="text" id="location" name="location" class="form-control" placeholder="Location">
			</div>
			<div class="line">
				<label for="start_date">Дата начала:</label>
				<input type="date" id="start_date" name="date" class="form-control" required>
			</div>
			<div class="line">
				<label for="start_date">Время начала:</label>
				<input type="time" id="start_time" name="time" class="form-control">
			</div>
			<div class="line">
				<label for="duration">Продолжительность (в днях):</label>
				<input type="number" id="duration" name="duration" class="form-control" placeholder="Days">
			</div>
			<div class="line">
				<label for="comment">Комментарий:</label><br>
				<textarea id="comment" name="comment" class="form-control" placeholder="Tell about your task"></textarea>
			</div>
			<div class="line">
				<button type="submit">Создать задачу</button>
			</div>
		</form>
		<div class="tasks">
			<div class="filter">
				<form action="tasks.php", method="POST">
					<div class="line">
						<h3>
							Фильтр
						</h3>
					</div>
					<div class="line">
						<label for="task_date">Дата начала:</label>
						<input type="date" id="task_date" name="task_date" class="form-control">
					</div>
					<div class="line">
						<label for="is_done">Выполено</label>
						<input type="checkbox" name="is_done" value="1">
					</div>
					<div class="line">
						<button type="submit">Применить</button>
					</div>
				</form>
				<a href="../index.php">Все задачи</a>
			</div>
			<div class="tasks_list">
				<?php
					$service = new TaskService();
					$data = [];
					if ((isset($_POST["task_date"]) && $_POST["task_date"] != '') || (isset($_POST["is_done"]) && $_POST["is_done"] != '')) {
						$where_params = ['owner_id' => $_COOKIE["user_id"]];
						if (isset($_POST["task_date"]) && $_POST["task_date"] != '') {
							$where_params['task_date'] = '"' . $_POST["task_date"] . '"';
						}
						if (isset($_POST["is_done"]) && $_POST["is_done"] != '') {
							$where_params['is_done'] = $_POST["is_done"];
						}

						$data = $service->get_tasks_with_params($where_params);
					} else {
						$data = $service->get_all_user_tasks($_COOKIE["user_id"]);
						$today_tasks = $service->get_all_tasks_for_taday($_COOKIE["user_id"]);
					
						if (count($today_tasks) == 0) {
							echo '<h3>На сегодня нет задач</h3>';
						} else {
							echo '<h3>Задачи на сегодня</h3>';
							echo '<div class="today_section">';
							foreach ($today_tasks as $value) {
								echo $value->print_data();
							}
							echo '</div>';
						}
					}
					$cur_date = "";
					foreach ($data as $value) {
						$date = $value->get_date();
						if ($cur_date == "") {
							$cur_date = $date;
							
							echo "<div class='date'>$cur_date</div>";
							echo '<div class="date_section">';
						} else if ($cur_date != $date) {
							$cur_date = $date;
							echo '</div>';
							echo "<div class='date'>$cur_date</div>";
							echo '<div class="date_section">';
						}
						echo $value->print_data();
					}
					if ($cur_date != "") {
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>