-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema x_task
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema x_task
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `x_task` DEFAULT CHARACTER SET utf8 ;
USE `x_task` ;

-- -----------------------------------------------------
-- Table `x_task`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `x_task`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `x_task`.`usuarios` (
  `usuarios_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(14) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `apellidos` VARCHAR(60) NULL,
  `password` VARCHAR(255) NULL,
  `password_encriptado` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`usuarios_id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  UNIQUE INDEX `password_encriptado_UNIQUE` (`password_encriptado` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `x_task`.`tareas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `x_task`.`tareas` ;

CREATE TABLE IF NOT EXISTS `x_task`.`tareas` (
  `tareas_id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(175) NULL,
  `descripcion` VARCHAR(437) NULL,
  `fecha_creacion` DATE NULL,
  `estado` TINYINT NULL,
  `usuarios_id` INT NOT NULL,
  PRIMARY KEY (`tareas_id`),
  INDEX `fk_tareas_usuarios_idx` (`usuarios_id` ASC) ,
  CONSTRAINT `fk_tareas_usuarios`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `x_task`.`usuarios` (`usuarios_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
