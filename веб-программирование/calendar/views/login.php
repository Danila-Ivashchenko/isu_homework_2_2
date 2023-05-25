<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/login.css?t=<?php echo(microtime(true).rand())?>">
	<title>Login</title>
</head>
<body>
	<?php
		require_once '../internal/users/service.php';
		$mess = "";
		$class = "";
		if (isset($_POST["username"]) && isset($_POST["password"])){
			$service = new UserService();
			$id = $service->get_id_by_username_and_pass($_POST["username"],$_POST["password"]);
			if ($id != -1) {
				$service->authentication($id, $_POST["username"]);
				header("Location: ../index.php");
				exit();
				$mess = "Успешно";
				$class = "success";
			} else {
				$mess = "Неверное имя пользователя или пароль";
				$class = "fail";
			}
		}
	?>
	<div class="wrapper">
		<div class="block">
			<a href="./register.php">зарегистрироваться</a>
			<form action="login.php" method="POST">
				<div class="line">
					<h3>Авторизация<h3>
				</div>
				<div class="line">
					<label for="username">Имя пользователя</label>
					<input type="text" name="username" id="username" required>
				</div>
				<div class="line">
					<label for="password">Пароль</label>
					<input type="password" name="password" id="password" required>
				</div>
				<div class="line">
					<button name="enter" type="submit">Войти</button>
				</div>
			</form>
		</div>
	</div>

</body>
</html>