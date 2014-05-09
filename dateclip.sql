SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `dateclip` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `dateclip` ;

-- -----------------------------------------------------
-- Table `dateclip`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fb_user_id` INT NULL,
  `full_name` VARCHAR(255) NULL,
  `first_name` VARCHAR(100) NULL,
  `last_name` VARCHAR(100) NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NULL,
  `gender` ENUM('M', 'F') NULL,
  `date_of_birth` DATE NULL,
  `location` VARCHAR(255) NULL,
  `profile_picture` VARCHAR(100) NULL,
  `create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `status` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NULL,
  `last_login` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`message` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `message` TEXT NULL,
  `owner` INT NOT NULL,
  `create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_message_user_idx` (`owner` ASC),
  CONSTRAINT `fk_message_user`
    FOREIGN KEY (`owner`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`dateclip`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`dateclip` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `dateclip` VARCHAR(100) NOT NULL,
  `create_date` TIMESTAMP NULL,
  `deleted` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_dateclip_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_dateclip_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`flag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`flag` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `flag` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`coach`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`coach` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `coach` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_flag_dateclip`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_flag_dateclip` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `dateclip_id` INT NOT NULL,
  `flag_id` INT NOT NULL,
  `other` VARCHAR(255) NULL,
  `create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_user_flag_dateclip_user1_idx` (`user_id` ASC),
  INDEX `fk_user_flag_dateclip_dateclip1_idx` (`dateclip_id` ASC),
  INDEX `fk_user_flag_dateclip_flag1_idx` (`flag_id` ASC),
  CONSTRAINT `fk_user_flag_dateclip_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_flag_dateclip_dateclip1`
    FOREIGN KEY (`dateclip_id`)
    REFERENCES `dateclip`.`dateclip` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_flag_dateclip_flag1`
    FOREIGN KEY (`flag_id`)
    REFERENCES `dateclip`.`flag` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_coach_dateclip`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_coach_dateclip` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `dateclip_id` INT NOT NULL,
  `coach_id` INT NOT NULL,
  `other` VARCHAR(255) NULL,
  `create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_user_flag_dateclip_user1_idx` (`user_id` ASC),
  INDEX `fk_user_flag_dateclip_dateclip1_idx` (`dateclip_id` ASC),
  INDEX `fk_user_flag_dateclip_copy1_coach1_idx` (`coach_id` ASC),
  CONSTRAINT `fk_user_flag_dateclip_user10`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_flag_dateclip_dateclip10`
    FOREIGN KEY (`dateclip_id`)
    REFERENCES `dateclip`.`dateclip` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_flag_dateclip_copy1_coach1`
    FOREIGN KEY (`coach_id`)
    REFERENCES `dateclip`.`coach` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_message` (
  `user_messages` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `message_id` INT NOT NULL,
  PRIMARY KEY (`user_messages`),
  INDEX `fk_table1_message1_idx` (`message_id` ASC),
  INDEX `fk_table1_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_table1_message1`
    FOREIGN KEY (`message_id`)
    REFERENCES `dateclip`.`message` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_flag_message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_flag_message` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `message_id` INT NOT NULL,
  `create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `status` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_user_flag_message_message1_idx` (`message_id` ASC),
  INDEX `fk_user_flag_message_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_flag_message_message1`
    FOREIGN KEY (`message_id`)
    REFERENCES `dateclip`.`message` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_flag_message_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`package`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`package` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `type` VARCHAR(45) NULL,
  `price` FLOAT NULL,
  `credit` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_package_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_package_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `package_id` INT NOT NULL,
  `transaction _id` VARCHAR(45) NULL,
  `purchase_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `status` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_user_package_user1_idx` (`user_id` ASC),
  INDEX `fk_user_package_package1_idx` (`package_id` ASC),
  CONSTRAINT `fk_user_package_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_package_package1`
    FOREIGN KEY (`package_id`)
    REFERENCES `dateclip`.`package` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_credit_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_credit_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL COMMENT '	',
  `action` VARCHAR(45) NULL,
  `operation` VARCHAR(45) NULL,
  `credit` INT NULL,
  `available_credit` INT NOT NULL,
  `create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_user_credit_log_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_credit_log_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`cms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`cms` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `page_type` VARCHAR(45) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NULL,
  `meta_keyword` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `last_updated` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_like_dateclip`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_like_dateclip` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `dateclip_id` INT NOT NULL,
  `create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_user_like_dateclip_user1_idx` (`user_id` ASC),
  INDEX `fk_user_like_dateclip_dateclip1_idx` (`dateclip_id` ASC),
  CONSTRAINT `fk_user_like_dateclip_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_like_dateclip_dateclip1`
    FOREIGN KEY (`dateclip_id`)
    REFERENCES `dateclip`.`dateclip` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_dislike_dateclip`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_dislike_dateclip` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `dateclip_id` INT NOT NULL,
  `create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_user_like_dateclip_user1_idx` (`user_id` ASC),
  INDEX `fk_user_like_dateclip_dateclip1_idx` (`dateclip_id` ASC),
  CONSTRAINT `fk_user_like_dateclip_user10`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_like_dateclip_dateclip10`
    FOREIGN KEY (`dateclip_id`)
    REFERENCES `dateclip`.`dateclip` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_search_settings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_search_settings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gender` ENUM('M', 'F') NULL,
  `looking_for` ENUM('M', 'F') NULL,
  `age_from` INT NULL,
  `age_to` INT NULL,
  `location_from` INT NULL,
  `location_to` INT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_search_settings_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_search_settings_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_invitee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_invitee` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fb_user_id` INT NULL,
  `invite_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_invitee_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_invitee_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`site_settings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`site_settings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `token` VARCHAR(45) NULL,
  `value` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`user_activity_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`user_activity_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `activity` VARCHAR(45) NULL,
  `associated_id` INT NULL,
  `create_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_activity_log_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_activity_log_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`mass_mailing`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`mass_mailing` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subject` VARCHAR(255) NULL,
  `message` TEXT NULL,
  `notification` TINYINT NULL DEFAULT 0,
  `create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dateclip`.`mass_mailing_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dateclip`.`mass_mailing_log` (
  `id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `mass_mailing_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_message_log_user1_idx` (`user_id` ASC),
  INDEX `fk_mass_mailing_log_mass_mailing1_idx` (`mass_mailing_id` ASC),
  CONSTRAINT `fk_message_log_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dateclip`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mass_mailing_log_mass_mailing1`
    FOREIGN KEY (`mass_mailing_id`)
    REFERENCES `dateclip`.`mass_mailing` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- --------------------------------------------------------
-- Table structure for table `ci_sessions`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `ci_cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- Table structure for table `ci_sessions`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
