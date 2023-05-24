CREATE DATABASE IF NOT EXISTS calendar;
USE calendar;

CREATE TABLE IF NOT EXISTS users (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	password VARCHAR(500)
);

CREATE TABLE IF NOT EXISTS tasks (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	owner_id INT UNSIGNED NOT NULL,
	type VARCHAR(255),
	theme VARCHAR(255),
	place VARCHAR(255),
	task_date DATE,
	task_time TIME,
	duration INT UNSIGNED,
	comment TEXT,
	is_done BOOLEAN DEFAULT FALSE,
	FOREIGN KEY (owner_id) REFERENCES users(id)
);

SELECT id, type, theme, place, date_time, duration, comment FROM tasks WHERE owner_id = 1;