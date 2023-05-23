<?php
	function get_conf() {
		$host = 'localhost';
		$dbname = 'conferences';
		$user = 'root';
		$pass = '';

		return ['host' => $host, 'dbname' => $dbname, 'user' => $user, 'pass' => $pass];
	}

	function get_db() {
		$data = get_conf();
		$pdo = new PDO("mysql:host=" . $data['host'] . ';' . 'dbname=' . $data['dbname'], $data['user'], $data['pass']);
		return $pdo;
	}

?>