<?php
session_start();	
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header('Location: notes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link href="./style/main.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
				include './templates/login_form.php';	

    ?>
</body>
</html>