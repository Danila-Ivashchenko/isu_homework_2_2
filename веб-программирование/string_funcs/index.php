<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="styles/main.css" rel="stylesheet">
	<title>Document</title>
</head>
<body>
<form class="main_form" method="POST" action="../funcs/register.php">
	<div class="line">
	<label>Имя участника</label>
	<input type=" text" name="name"><br>
	</div>
	<div class="line">
	<label>Фамилия участника</label>
	<input type="text" name="surname"><br>
	</div>
	<div class="line">
	<label>Электронный адрес</label>
	<input type="email" name="email"><br>
	</div>
	<div class="line">
	<label>Телефон для связи</label>
	<input type="tel" name="phone"><br>
	</div>
	<div class="line">
	<label>Интересующая тематика конференции:</label><br>
	<select name="topic">
		<option value="Бизнес">Бизнес</option>
		<option value="Технологии">Технологии</option>
		<option value="Реклама и Маркетинг">Реклама и Маркетинг</option>
	</select>
	</div>
	<div class="line">
	<label>Предпочитаемый метод оплаты:</label><br>
	<select name="payment_method">
		<option value="WebMoney">WebMoney</option>
		<option value="Яндекс.Деньги">Яндекс.Деньги</option>
		<option value="PayPal">PayPal</option>
		<option value="Кредитная карта">Кредитная карта</option>
	</select>
	</div>
	<div class="line">
	<label for="newsletter">Хотите получать рассылку о конференции?</label>
	<input type="checkbox" name="newsletter" id="newsletter"><br>
	</div>
	<div class="line">
	<button name="enter" type="submit">Отправить</button>
	</div>
</form>
</body>
</html>