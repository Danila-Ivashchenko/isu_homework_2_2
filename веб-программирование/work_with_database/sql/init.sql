CREATE DATABASE conferences;
USE conferences;

CREATE TABLE subjects (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255)
);

CREATE TABLE payments (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	title VARCHAR(255)
);

CREATE TABLE `participants` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `lastname` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `tel` VARCHAR(255) NOT NULL,
  `subject_id` INT(10) UNSIGNED NOT NULL,
  `payment_id` INT(10) UNSIGNED NOT NULL,
  `mailing` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NOT NULL,
  PRIMARY KEY(`id`),
  INDEX `deleted_at` (`deleted_at`)
);

INSERT INTO subjects (title) VALUES ('Бизнес'), ('Технологии'), ('Реклама и Маркетинг');
INSERT INTO payments (title) VALUES ('WebMoney'), ('Яндекс Деньги'), ('Paypal'), ('Кредитная карта');


-- SELECT participants.id, participants.name, participants.lastname, participants.email, participants.tel, subjects.title, payments.title, participants.mailing, participants.deleted_at, participants.created_at, participants.updated_at FROM participants, subjects, payments WHERE participants.subject_id = subjects.id AND participants.payment_id = payments.id
-- UPDATE participants SET deleted_at = '', updated_at = '';