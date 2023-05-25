<?php
	require_once '../internal/database/database.php';
	require_once "model.php";


	class UserService {
		public function registrate_new_user($username, $password) {
			if ($this->is_user_exist($username)) {
				return -1;
			}
			$db = get_db();
			$hash_pass = sha1($password);

			$sql = 'INSERT INTO users (username, password) VALUES (?, ?)';
			$stmt = $db->prepare($sql);
			$stmt->execute([$username, $hash_pass]);
			$id = $db->lastInsertId();
			$db = null;
			return $id;
		}

		public function is_user_exist($username) {
			$db = get_db();
			$sql = 'SELECT 1 FROM users WHERE username = ?';
			$stmt = $db->prepare($sql);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->execute([$username]);
			// $result = $stmt->fetchAll(PDO::FETCH_NUM);
			return count($result) > 0;
		}

		public function get_id_by_username_and_pass($username, $password){
			$db = get_db();
			$sql = 'SELECT id FROM users WHERE username = ? AND password = ?';
			$stmt = $db->prepare($sql);

			$stmt->execute([$username, sha1($password)]);
			$result = $stmt->fetchAll(PDO::FETCH_NUM);

			return count($result) > 0 ? $result[0][0] : -1;
		}

		public function authentication($id, $user_name) {
			setcookie("user_id", $id, time() + (30 * 24 * 60 * 60), "/");
			setcookie("user_name", $user_name, time() + (30 * 24 * 60 * 60), "/");
			return true;
		}

	}

