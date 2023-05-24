<?php
	setcookie('user_id', '-1', time() - 3600, '/');
	header("Location: ../index.php");
	exit();
?>