-- CREATE DATABASE `ikemengo`;

CREATE TABLE `ikemengo`.`mens` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gnavi_id` VARCHAR(50) NULL,
  `photo` MEDIUMBLOB NULL,
  `comment` TEXT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `ikemengo`.`goods` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gnavi_id` VARCHAR(50) NULL,
  `good` INT NULL,
  `date_at` DATETIME NULL,
  PRIMARY KEY (`id`));
