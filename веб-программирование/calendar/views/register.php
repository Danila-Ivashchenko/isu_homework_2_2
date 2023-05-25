<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/login.css?t=<?php echo(microtime(true).rand())?>">

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
				$service->authentication($id, $_POST["username"]);
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
	<div class="wrapper">
		<div class="block">
			<a href="./login.php">авторизироваться</a>
			<form method="POST" action="register.php">
				<div class="line">
					<h3>Регистрация</h3>
				</div>
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
		</div>
	</div>
	
</body>
</html>