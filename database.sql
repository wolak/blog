CREATE SCHEMA `blog` ;
CREATE  TABLE `blog`.`user_types` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) );
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `user_type_id` bigint(20) unsigned DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `usertype_idx` (`user_type_id`),
  CONSTRAINT `usertype` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);


INSERT INTO `blog`.`user_types` (`type`) VALUES ('reader');
INSERT INTO `blog`.`user_types` (`type`) VALUES ('author');

INSERT INTO `blog`.`users` (`name`, `username`, `user_type_id`) VALUES ('Reader 1', 'reader1', '1');
INSERT INTO `blog`.`users` (`name`, `username`, `user_type_id`) VALUES ('Reader 2', 'reader2', '1');
INSERT INTO `blog`.`users` (`name`, `username`, `user_type_id`) VALUES ('Reader 3', 'reader3', '1');
INSERT INTO `blog`.`users` (`name`, `username`, `user_type_id`) VALUES ('Reader 4', 'reader4', '1');
INSERT INTO `blog`.`users` (`name`, `username`, `user_type_id`) VALUES ('Author 1', 'author1', '2');
INSERT INTO `blog`.`users` (`name`, `username`, `user_type_id`) VALUES ('Author 2', 'author2', '2');
INSERT INTO `blog`.`users` (`name`, `username`, `user_type_id`) VALUES ('Author 3', 'author3', '2');
INSERT INTO `blog`.`users` (`name`, `username`, `user_type_id`) VALUES ('Author 4', 'author4', '2');

CREATE  TABLE `blog`.`posts` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `post` TEXT NULL ,
  `title` VARCHAR(100) NULL ,
  `user_id` BIGINT(20) UNSIGNED NOT NULL ,
  `created_on` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  `modified_on` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `user_id_idx` (`user_id` ASC) ,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `blog`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE  TABLE `blog`.`comments` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `comment` TEXT NULL ,
  `user_id` BIGINT(20) UNSIGNED NULL ,
  `post_id` BIGINT(20) UNSIGNED NULL,
  `created_on` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  `modified_on` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) );
