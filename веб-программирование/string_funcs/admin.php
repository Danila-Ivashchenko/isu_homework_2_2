<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="styles/main.css" rel="stylesheet">
	<link href="styles/table_style.css" rel="stylesheet">
	<title>Document</title>
</head>
<body>
<div class="table-users">
    <?php

	require_once "./funcs/parse_data.php";

	function add_record($data) {
		$row = '<tr>';
        for ($i = 1; $i < count($data); $i++) {
            $row .= '<td>' . $data[$i] . '</td>';
        }

		if ($data[9] == "ACTIVE\n") {
        	$row .= '<td><form method="post" action="./funcs/delete.php"><input type="hidden" name="id" value="' . $data[0] . '"><button type="submit" name="delete" value="Delete">Delete</button></form></td>';
		} else {
			$row .= '<td><form method="post" action="./funcs/activate.php"><input type="hidden" name="id" value="' . $data[0] . '"><button type="submit" name="activate" value="Activate">Activate</button></form></td>';
		}
		$row .= '</tr>';
        return $row;
	}

    function add_records($datas) {
        $rows = "";
		foreach ($datas as $data){
			$rows .= add_record($data);
		}
		
        return $rows;
    }

    $table = '<table><thead><tr><th>Имя</th><th>Фамилия</th><th>E-mail</th><th>Телефон</th><th>Тематика конференции</th><th>Метод оплаты</th><th>Получать рассылку</th><th>Дата</th><th>Время</th><th>Статус</th><th>Удалить</th></thead><tbody>';

	$data = parse_data('./static/data.txt');
	$table .= add_records($data);

    $table .= '</tbody></table>';

    echo $table;
    ?>
</div>

</body>
</html>