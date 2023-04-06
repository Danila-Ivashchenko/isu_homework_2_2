<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Администратор</title>
</head>

<body>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>

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

    $file_dir = './files';

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
