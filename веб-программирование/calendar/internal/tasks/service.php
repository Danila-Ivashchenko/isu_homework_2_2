<?php
	require_once '../internal/database/database.php';
	require_once "model.php";

	class TaskService {
		public function add_task($task_data) {
			$db = get_db();
			$sql = 'INSERT INTO tasks (owner_id, type, theme, place, task_date, task_time, duration, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
			$stmt = $db->prepare($sql);
			print_r($task_data);
			$stmt->execute($task_data);
			$db = null;
			return true;
		}

		public function update_task($task_data) {
			print_r($task_data);
			$db = get_db();
			// $sql = 'UPDATE tasks SET type = "?", theme = "?", place = "?", task_date = "?", task_time = "?", duration = "?", comment = "?" WHERE id = ?';
			$sql = 'UPDATE tasks SET type = :type, theme = :theme, place = :location, task_date = :date, task_time = :time, duration = :duration, comment = :comment WHERE id = :task_id';
			$stmt = $db->prepare($sql);
			print_r($task_data);
			// $stmt->execute([$task_data["type"], $task_data["theme"], $task_data["location"], $task_data["date"], $task_data["time"], $task_data["duration"], $task_data["comment"], $task_data["task_id"]]);
			$stmt->execute($task_data);
			$db = null;
			return true;
		}

		public function get_task($id) {
			$data = $this->get_all_tasts("id = $id");
			if (count($data) == 0) {
				return null;
			}
			return $data[0];
		}

		public function get_all_tasts($where_case = "") {
			$sql = 'SELECT * FROM tasks';
			if ($where_case != "") {
				$sql .= " WHERE $where_case";
			}
			$sql .= ' ORDER BY task_date, task_time';

			$db = get_db();
			$stmt = $db->prepare($sql);
			$stmt->execute([]);
			$result = $stmt->fetchAll(PDO::FETCH_NUM);
			$data = [];
			foreach ($result as $row) {
				array_push($data, new Task($row));
			}
			return $data;
		}

		public function make_task_done($task_id) {
			$sql = 'UPDATE tasks SET is_done = !is_done WHERE id = ?';
			$db = get_db();
			$stmt = $db->prepare($sql);
			$stmt->execute([$task_id]);
			return true;
		}

		public function delete_task($task_id) {
			$sql = 'DELETE FROM tasks WHERE id = ? LIMIT 1';
			$db = get_db();
			$stmt = $db->prepare($sql);
			$stmt->execute([$task_id]);
			return true;
		}

		public function get_all_user_tasks($user_id) {
			return $this->get_all_tasts("owner_id = $user_id");
		}

		public function get_all_user_tasks_in_date($user_id, $date) {
			return $this->get_all_tasts("owner_id = $user_id AND task_date = '$date'");
		}

		public function get_all_tasks_for_taday($user_id){
			$date = date("Y-m-d");
			return $this->get_all_tasts("owner_id = $user_id AND task_date = '$date'");
		}

		public function get_all_user_tasks_lated($user_id, $date) {
			return $this->get_all_tasts("owner_id = $user_id AND task_date < '$date'");
		}

		public function get_tasks_with_params($where_params) {
			$where_case = "";
			$n = count($where_params);
			$i = 0;
			foreach ($where_params as $key => $value) {
				$where_case .= " $key = $value";
				$i += 1;
				if ($i < $n) {
					$where_case .= ' AND';
				}
			}

			return $this->get_all_tasts($where_case);
		}
	}

?>