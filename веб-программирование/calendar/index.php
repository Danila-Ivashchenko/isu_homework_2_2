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
	if (!isset($_COOKIE["user_id"])) {
		header("Location: ./views/login.php");
		exit();
	} else {
		header("Location: ./views/tasks.php");
		exit();
	}
	?>
</body>
</html>