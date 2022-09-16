-- -----------------------------------------------------
-- Schema twitterdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `twitterdb` DEFAULT CHARACTER SET utf8 ;
USE `twitterdb` ;

-- -----------------------------------------------------
-- Table `twitterdb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`users` (
  `id` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `data_of_birth` DATE NOT NULL,
  `date_of_registration` DATE NOT NULL,
  `bio` VARCHAR(255) NULL,
  `location` VARCHAR(45) NULL,
  `profile_picture_link` VARCHAR(255) NULL,
  `banner_picture_link` VARCHAR(255) NULL,
  `website` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),

-- -----------------------------------------------------
-- Table `twitterdb`.`tweets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`tweets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tweet_text` VARCHAR(280) NOT NULL,
  `tweet_image_link` VARCHAR(255) NULL,
  `date_time_of_creation` DATETIME(45) NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`, `user_id`),
  CONSTRAINT `fk_tweets_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `twitterdb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
-- Table `twitterdb`.`likes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`likes` (
  `user_id` INT NOT NULL,
  `tweet_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `tweet_id`),
  CONSTRAINT `fk_users_has_tweets_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `twitterdb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_tweets_tweets1`
    FOREIGN KEY (`tweet_id`)
    REFERENCES `twitterdb`.`tweets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
-- Table `twitterdb`.`block`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`block` (
  `user_id` INT NOT NULL,
  `blocked_user_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `blocked_user_id`),
  CONSTRAINT `fk_users_has_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `twitterdb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_users_users2`
    FOREIGN KEY (`blocked_user_id`)
    REFERENCES `twitterdb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
-- Table `twitterdb`.`followers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`followers` (
  `users_id` INT NOT NULL,
  `follower_user_id` INT NOT NULL,
  PRIMARY KEY (`users_id`, `follower_user_id`),
  CONSTRAINT `fk_users_has_users_users3`
    FOREIGN KEY (`users_id`)
    REFERENCES `twitterdb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_users_users4`
    FOREIGN KEY (`follower_user_id`)
    REFERENCES `twitterdb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

