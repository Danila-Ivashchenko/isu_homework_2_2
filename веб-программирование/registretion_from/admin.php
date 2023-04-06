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
<div class="table-users">
    <?php

    function parse_file($file_path)
    {
        $data = array();
        $lines = file($file_path);
        foreach ($lines as $line) {
            list($key, $value) = explode(": ", $line);
            $data[$key] = trim($value);
        }
        return $data;
    }

    // Function to generate table rows with delete button
    function generate_table_row($filename)
    {
        $data = parse_file($filename);
        $row = '<tr>';
        foreach ($data as $key => $value) {
            $row .= '<td>' . $value . '</td>';
        }
        $row .= '<td><form method="post" action=""><input type="hidden" name="filename" value="' . $filename . '"><button type="submit" name="delete" value="Delete">Delete</button></form></td>';
        $row .= '</tr>';
        return $row;
    }

    $file_dir = './static';

    // Удаление
    if (isset($_POST['delete'])) {
        if (file_exists($_POST['filename'])) {
            unlink($_POST['filename']);
        }
    }

    // Генерация таблицы по файлам
    $table = '<table><thead><tr><th>Имя</th><th>Фамилия</th><th>E-mail</th><th>Телефон</th><th>Тематика конференции</th><th>Метод оплаты</th><th>Получать рассылку</th><th></th></tr></thead><tbody>';

	 foreach (glob($file_dir . '/*.txt') as $filename) {
        $table .= generate_table_row($filename);
    }
    $table .= '</tbody></table>';

    echo $table;
    ?>
</div>

</body>
</html>