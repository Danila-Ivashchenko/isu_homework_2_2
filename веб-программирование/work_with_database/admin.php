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

	require_once "./database/database.php";
	require_once "./funcs/parse_data.php";

	function get_all_data() {
		$db = get_db();
		$data = $db->query('SELECT participants.id, participants.name, participants.lastname, participants.email, participants.tel, subjects.title as subject, payments.title as payment, participants.mailing, participants.deleted_at, participants.created_at, participants.updated_at FROM participants, subjects, payments WHERE participants.subject_id = subjects.id AND participants.payment_id = payments.id');
		$ret_data = array();
		while ($row = $data->fetch(PDO::FETCH_OBJ)) {
			array_push($ret_data, $row);
		}
		// print_r($ret_data);
		// echo '<br>';
		return $ret_data;
	}

	function add_record($data) {
		// print_r($data);
		$row = '<tr>';
		$status = false;
		$id = 0;
        foreach ($data as $key => $value) {
			// echo $key . ' - ' . $value . '<br>';
			if (!isset($value)) {
				$row .= '<td>null</td>';
				$status = true;
				continue;
			}
			if ($key == 'id') {
				$id = $value;
			}
			if ($key == 'mailing') {
				$val = $value ? 'да' : 'нет';
				// echo $val . '<br>';	
				$row .= '<td>' . $val . '</td>';
				continue;
			}
			$row .= "<td>$value</td>";
        }

		if ($status) {
			$row .= '<td>ACTIVE</td>';
			$row .= '<td><form method="post" action="./funcs/delete.php"><input type="hidden" name="id" value="' . $id . '"><button type="submit" name="delete" value="Delete">Delete</button></form></td>';
		} else {
			$row .= '<td>DELETED</td>';
			$row .= '<td><form method="post" action="./funcs/activate.php"><input type="hidden" name="id" value="' . $id . '"><button type="submit" name="activate" value="Activate">Activate</button></form></td>';
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

    $table = '<table><thead><tr><th>ID</th><th>Имя</th><th>Фамилия</th><th>E-mail</th><th>Телефон</th><th>Тематика конференции</th><th>Метод оплаты</th><th>Получать рассылку</th><th>Время удаление</th><th>Время создания</th><th>Послднее обновление</th><th>Статус</th><th>Удалить</th></thead><tbody>';
	$data = get_all_data();
	$table .= add_records($data);

    $table .= '</tbody></table>';

    echo $table;
    ?>
</div>

</body>
</html>