<?php

	class User {
		private	$id;
		private	$username;
		private	$password;

		public function __construct($id, $username){
			$this->id = $id;
			$this->username = $username;
		}

		public function get_id(){
			return $this->id;
		}

		public function get_username(){
			return $this->username;
		}
	}