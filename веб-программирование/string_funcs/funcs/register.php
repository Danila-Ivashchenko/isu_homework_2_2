<?php
require_once "answers.php";
if ((isset($_POST["name"]) && $_POST["name"] !="") &&
	(isset($_POST["surname"]) && $_POST["surname"] !="") &&
	(isset($_POST["email"]) && $_POST["email"] !="") &&
	(isset($_POST["phone"]) && $_POST["phone"] !="") &&
	(isset($_POST["topic"]) && $_POST["topic"] !="") &&
	(isset($_POST["payment_method"]) && $_POST["payment_method"] !="")
	){
		foreach ($_POST as $value) {
			$pos = strpos($value, '|');
			if ($pos !== false) {
				fail("Недопустимый символ '|' в $value");
				exit;
			}
		}
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$topic = $_POST['topic'];
		$payment_method = $_POST['payment_method'];
		$newsletter = isset($_POST['newsletter']) ? 'да' : 'нет';
		$date = date("Y-m-d");
		$time = date("H:i:s");

		$status = "ACTIVE";
		$data = "$name|$surname|$email|$phone|$topic|$payment_method|$newsletter|$date|$status";

		$hash = hash('sha256', $data);
		file_put_contents("../static/data.txt", "$hash|$data\n", FILE_APPEND);

		accepted();
	}
else{
	fail("Не все поля заполнены!");
}
