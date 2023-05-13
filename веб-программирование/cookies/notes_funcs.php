<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_COOKIE['username'])) {

    $notes = unserialize($_COOKIE['notes']);

    if ($_POST['action'] === 'save' && !empty($_POST['done'])) {
        foreach ($notes as $note_key => $note) {
            if (in_array($note['text'], $_POST['done'])) {
                $notes[$note_key]['done'] = 'true';
            } else {
                $notes[$note_key]['done'] = 'false';
            }
        }
        setcookie('notes', serialize($notes), time() + 1800);
    } elseif ($_POST['action'] === 'delete' && !empty($_POST['done'])) {
        foreach ($notes as $key => $note) {
            if (in_array($note['text'], $_POST['done'])) {
                unset($notes[$key]);
            }
        }
        setcookie('notes', serialize($notes), time() + 1800);
    } elseif ($_POST['action'] === 'clear_all') {
        $notes = array();
        setcookie('notes', serialize($notes), time() + 1800);
    } elseif ($_POST['action'] === 'create') {
        $note = $_POST['note'];
        if ($note !== '') {
            $note = array(
                'text' => $note,
                'done' => 'false'
            );
            $notes[] = $note;
            setcookie('notes', serialize($notes), time() + 1800);
        }
    }
    header('Location: notes.php');
    exit;
} else {
    header('Location: index.php');
}

?>