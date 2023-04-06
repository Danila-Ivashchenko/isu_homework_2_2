<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/registration.css">
    <title>Регистрация</title>
</head>

<body>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form method="POST" action="../functions/registration.php">
    <label>Имя участника</label>
    <input type=" text" name="name"><br>

    <label>Фамилия участника</label>
    <input type="text" name="surname"><br>

    <label>Электронный адрес</label>
    <input type="email" name="email"><br>

    <label>Телефон для связи</label>
    <input type="tel" name="phone"><br>

    <label>Интересующая тематика конференции:</label><br>
    <select name="topic">
        <option value="Бизнес">Бизнес</option>
        <option value="Технологии">Технологии</option>
        <option value="Реклама и Маркетинг">Реклама и Маркетинг</option>
    </select>

    <label>Предпочитаемый метод оплаты:</label><br>
    <select name="payment_method">
        <option value="WebMoney">WebMoney</option>
        <option value="Яндекс.Деньги">Яндекс.Деньги</option>
        <option value="PayPal">PayPal</option>
        <option value="Кредитная карта">Кредитная карта</option>
    </select>

    <label for="newsletter">Хотите получать рассылку о конференции?</label>
    <input type="checkbox" name="newsletter" id="newsletter"><br>

    <button name="enter" type="submit">Отправить</button>
</form>
</body>

</html>