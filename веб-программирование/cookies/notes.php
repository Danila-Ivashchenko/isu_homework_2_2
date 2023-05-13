<?php
session_start();	
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link href="./style/notes.css" rel="stylesheet">
    <title>Заметки</title>
</head>
<body>
    <?php

        if (isset($_COOKIE['username'])) {
          	     				
            if (isset($_COOKIE['notes'])) {
              $notes = unserialize($_COOKIE['notes']);
            } else {
              $notes = array();
              setcookie('notes', serialize($notes), time() + 1800);
            }

            if (!empty($notes)) {
                echo '<form action="notes_funcs.php" method="post">';
                echo '<button type="submit" name="action" value="save">Выполнено</button>';
                echo '<button type="submit" name="action" value="delete">Удалить</button>';
                echo '<button type="submit" name="action" value="clear_all">Удалить все заметки</button>';
                echo '<ul>';
                foreach ($notes as $note) {
                    echo '<li';
                    if ($note['done'] === 'true') {
                        echo ' class="done"';
                    }
                    echo '>';
                    echo '<input type="checkbox" name="done[]" value="' . $note['text'] . '"';
                    echo '>' . $note['text'];
                    echo '</li>';
                }
                echo '</ul>';
                echo '</form>';
            } else {
                echo '<p class="info">У вас пока нет заметок.</p>';
            }
        }
        require "./templates/add_note.php";
    ?>
</body>
</html>