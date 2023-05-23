<?php

function accepted(){
	echo <<<__MESS
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link href="../styles/main.css" rel="stylesheet">
	</head>
	<body>
		<div class="mess good">Ваша заявка принята</div>
		<a href="../index.php"><button onclick=''>На главную</button></a>
	</body>
	</html>
__MESS;
}

function fail($error){
	echo <<<__MESS
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link href="../styles/main.css" rel="stylesheet">
	</head>
	<body>
		<div class="mess bad">$error</div>
		<button onclick='history.back();'>Назад</button>
	</body>
	</html>
__MESS;

}

?>