<?php
	
	class Task{
		private $id;
		private $owner_id;
		private $type;
		private $theme;
		private $place;
		private $date_time;
		private $duration;
		private $comment;

		public function __construct($data) {
			$this->id = $data[0];
			$this->owner_id = $data[1];
			$this->type = $data[2];
			$this->theme = $data[3];
			$this->place = $data[4];
			$this->date = $data[5];
			$this->time = $data[6];
			$this->duration = $data[7];
			$this->comment = $data[8];
			$this->is_done = $data[9];

		}

		public function get_date() {
			return $this->date;
		}

		public function get_all_data() {
			return [$this->id, $this->owner_id, $this->type, $this->theme, $this->place, $this->date, $this->time, $this->duration, $this->is_done, $this->comment];
		}

		public function print_data() {
			$result = '<div class="task">';
			$data = $this->get_all_data();

			$status =  $data[8] == 1 ? 'сделано' : 'несделано';
			$task_id = $data[0];
			$status_class = $data[8] == 1 ? 'done' : 'not-done';
			$result .= "<form action='../funcs/make_task_done.php' method='POST'><input type='hidden' name='task_id' value='$task_id'><input type='submit' value='Завершить'></form>";
			$result .= "<form action='curent_task.php' method='GET'><input type='hidden' name='task_id' value='$task_id'><input type='submit' value='Редактировать'></form>";
			$result .= '<div class="item">' . '<span>Id</span>' . '<span>' . $data[0] .'</span></div>';
			$result .= '<div class="item">' . '<span>Id владельца</span>' . '<span>' . $data[1] .'</span></div>';
			$result .= '<div class="item">' . '<span>Тип</span>' . '<span>' . $data[2] .'</span></div>';
			$result .= '<div class="item">' . '<span>Тема</span>' . '<span>' . $data[3] .'</span></div>';
			$result .= '<div class="item">' . '<span>Место</span>' . '<span>' . $data[4] .'</span></div>';
			$result .= '<div class="item">' . '<span>Дата начала</span>' . '<span>' . $data[5] .'</span></div>';
			$result .= '<div class="item">' . '<span>Время начала</span>' . '<span>' . $data[6] .'</span></div>';
			$result .= '<div class="item">' . '<span>Продолжительность</span>' . '<span>' . $data[7] .'</span></div>';
			$result .= '<div class="item">' . "<span class='$status_class'>Статус</span>" . '<span>' . $status .'</span></div>';
			$result .= '<div class="item">' . '<span>Комментарий</span>' . '<span>' . $data[9] .'</span></div>';
			$result .= '</div>';
			return $result;
		}

		public function print_big_data() {
			
		}
	}
?>