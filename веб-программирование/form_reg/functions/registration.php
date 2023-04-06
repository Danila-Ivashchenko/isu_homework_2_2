<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['phone']) ||
        empty($_POST['topic']) || empty($_POST['payment_method'])) {
        include "../templates/discard_registration.php";
    } else {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $topic = $_POST['topic'];
        $payment_method = $_POST['payment_method'];
        $newsletter = isset($_POST['newsletter']) ? 'да' : 'нет';

        $filename = uniqid() . '.txt';

        $data = "Имя: $name\nФамилия: $surname\nE-mail: $email\nТелефон: $phone\nТематика конференции: $topic\nМетод оплаты: $payment_method\nЖелание получать рассылку: $newsletter";
        file_put_contents("../files/" . $filename, $data);
        include "../templates/accept_registration.php";
    }
}