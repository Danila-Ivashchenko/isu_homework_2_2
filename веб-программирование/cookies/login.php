<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'user' && $password === 'qwer') {
	 	$_SESSION['logged_in'] = true;
    $_SESSION['expire_time'] = time() + 1800;
    setcookie('username', 'user', time() + 1800);
    session_set_cookie_params(1800);
    ini_set('session.gc_maxlifetime', 1800);
    header('Location: notes.php');
    exit;
} else {
    header('Location: index.php?error=неправильное имя пользователя или пароль');
    exit;
}

?>