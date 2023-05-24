<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
		require_once '../internal/users/service.php';

		$service = new UserService();
		$mess = "";
		$class = "";
		if (isset($_POST["username"]) && isset( $_POST["password"])) {
			$id = $service->registrate_new_user($_POST["username"], $_POST["password"]);
			if ($id != -1) {
				$mess = "Успешно";
				$class = "success";
				$service->authentication($id);
				header("Location: ../index.php");
				exit();
			} else {
				$mess = "Ошибка";
				$class = "fail";
			}
			echo "<div class='$class'>$mess</div>";
		}
	?>
	
	<?php
		
	?>
	<form method="POST" action="register.php">
		<div class="line">
			<label for="username">Имя пользователя</label>
			<input type="text" name="username" id="username" required>
		</div>
		<div class="line">
			<label for="password">Пароль</label>
			<input type="password" name="password" id="password" required>
		</div>
		<button name="enter" type="submit">Отправить</button>
	</form>
	
</body>
</html>