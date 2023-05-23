<?php
require_once "answers.php";
require_once "../database/database.php";

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
		$db = get_db();
		$sql = "INSERT INTO participants (name, lastname, email, tel, subject_id, payment_id, mailing, created_at, updated_at) 
						VALUES (:name, :lastname, :email, :tel, :subject_id, :payment_id, :mailing, :created_at, :updated_at)";
		$stmt = $db->prepare($sql);

		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$topic = $_POST['topic'];
		$payment_method = $_POST['payment_method'];
		$newsletter = isset($_POST['newsletter']) ? 1 : 0;
		$date = date("Y-m-d");
		$time = date("H:i:s");

		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':lastname', $surname);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':tel', $phone);
		$stmt->bindValue(':subject_id', $topic);
		$stmt->bindValue(':payment_id', $payment_method);
		$stmt->bindValue(':mailing', $newsletter);
		$stmt->bindValue(':created_at', $date . ' ' . $time);
		$stmt->bindValue(':updated_at', $date . ' ' . $time);
		$stmt->execute();

		accepted();
	}
else{
	fail("Не все поля заполнены!");
}
