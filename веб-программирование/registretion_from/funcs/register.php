<?php
require_once "answers.php";
if ((isset($_POST["name"]) && $_POST["name"] !="") &&
	(isset($_POST["surname"]) && $_POST["surname"] !="") &&
	(isset($_POST["email"]) && $_POST["email"] !="") &&
	(isset($_POST["phone"]) && $_POST["phone"] !="") &&
	(isset($_POST["topic"]) && $_POST["topic"] !="") &&
	(isset($_POST["payment_method"]) && $_POST["payment_method"] !="")
	){
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$topic = $_POST['topic'];
		$payment_method = $_POST['payment_method'];
		$newsletter = isset($_POST['newsletter']) ? 'да' : 'нет';
		$date = date("Y-m-d");
		$time = date("H:i:s");
		$filename = uniqid($email) . '.txt';

		$data = "Имя: $name\nФамилия: $surname\nE-mail: $email\nТелефон: $phone\nТематика конференции: $topic\nСпособ оплаты: $payment_method\nСогласие на рассылку: $newsletter\nДата: $date\nВремя: $time";
		file_put_contents("../static/" . $filename, $data);
		accepted();
	}
else{
	fail($_POST["name"]);
}
