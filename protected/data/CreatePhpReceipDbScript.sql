SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `phprecipedb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `phprecipedb` ;

-- -----------------------------------------------------
-- Table `phprecipedb`.`ingredient`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`ingredient` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`ingredient` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'private key of ingredient' ,
  `name` VARCHAR(64) NOT NULL COMMENT 'name of ingredient' ,
  `unit_usage` BIT(3) NULL COMMENT 'bit field for allowed usage types (base types only)\n0 bit: gramm\n1 bit: ml\n2 bit: pieces' ,
  PRIMARY KEY (`id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `phprecipedb`.`unit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`unit` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`unit` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `short_desc` VARCHAR(20) NOT NULL ,
  `description` VARCHAR(64) NOT NULL ,
  `usable_flag` BIT(3) NULL COMMENT 'bit 0 = 1 = usable for recipe quantity\nbit 0 = 2 = usable for ingredient quantity\nbit 0 = 4 = usable for nutriation quantity' ,
  PRIMARY KEY (`id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `phprecipedb`.`recipe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`recipe` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`recipe` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(60) NOT NULL ,
  `description` VARCHAR(256) NULL ,
  `quantity` FLOAT NULL ,
  `unit_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_recipe_unit1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `phprecipedb`.`unit` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;

CREATE UNIQUE INDEX `id_UNIQUE` ON `phprecipedb`.`recipe` (`id` ASC) ;

CREATE INDEX `fk_recipe_unit1` ON `phprecipedb`.`recipe` (`unit_id` ASC) ;


-- -----------------------------------------------------
-- Table `phprecipedb`.`preperation_step`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`preperation_step` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`preperation_step` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(64) NOT NULL ,
  `description` TEXT NOT NULL ,
  `recipe_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`, `recipe_id`) ,
  CONSTRAINT `fk_preperation_step_recipe1`
    FOREIGN KEY (`recipe_id` )
    REFERENCES `phprecipedb`.`recipe` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;

CREATE UNIQUE INDEX `id_UNIQUE` ON `phprecipedb`.`preperation_step` (`id` ASC) ;

CREATE INDEX `fk_preperation_step_recipe1` ON `phprecipedb`.`preperation_step` (`recipe_id` ASC) ;


-- -----------------------------------------------------
-- Table `phprecipedb`.`nutrition`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`nutrition` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`nutrition` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(64) NOT NULL ,
  PRIMARY KEY (`id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `phprecipedb`.`ingredient_section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`ingredient_section` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`ingredient_section` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `recipe_id` INT UNSIGNED NOT NULL ,
  `seq_no` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`, `recipe_id`) ,
  CONSTRAINT `fk_ingredient_section_recipe1`
    FOREIGN KEY (`recipe_id` )
    REFERENCES `phprecipedb`.`recipe` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_ingredient_section_recipe1` ON `phprecipedb`.`ingredient_section` (`recipe_id` ASC) ;


-- -----------------------------------------------------
-- Table `phprecipedb`.`ingredient_entry`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`ingredient_entry` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`ingredient_entry` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `ingredient_section_id` INT UNSIGNED NOT NULL ,
  `ingredient_section_recipe_id` INT UNSIGNED NOT NULL ,
  `ingredient_id` INT UNSIGNED NOT NULL ,
  `unit_id` INT UNSIGNED NOT NULL ,
  `quantity` FLOAT NULL ,
  PRIMARY KEY (`id`, `ingredient_section_id`, `ingredient_section_recipe_id`) ,
  CONSTRAINT `fk_ingredient_entry_ingredient`
    FOREIGN KEY (`ingredient_id` )
    REFERENCES `phprecipedb`.`ingredient` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ingredient_entry_unit`
    FOREIGN KEY (`unit_id` )
    REFERENCES `phprecipedb`.`unit` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ingredient_entry_ingredient_section1`
    FOREIGN KEY (`ingredient_section_id` , `ingredient_section_recipe_id` )
    REFERENCES `phprecipedb`.`ingredient_section` (`id` , `recipe_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;

CREATE UNIQUE INDEX `id_UNIQUE` ON `phprecipedb`.`ingredient_entry` (`id` ASC) ;

CREATE INDEX `fk_ingredient_entry_ingredient` ON `phprecipedb`.`ingredient_entry` (`ingredient_id` ASC) ;

CREATE INDEX `fk_ingredient_entry_unit` ON `phprecipedb`.`ingredient_entry` (`unit_id` ASC) ;

CREATE INDEX `fk_ingredient_entry_ingredient_section1` ON `phprecipedb`.`ingredient_entry` (`ingredient_section_id` ASC, `ingredient_section_recipe_id` ASC) ;


-- -----------------------------------------------------
-- Table `phprecipedb`.`nutrition_entry`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`nutrition_entry` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`nutrition_entry` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nutrition_id` INT UNSIGNED NOT NULL ,
  `unit_id` INT UNSIGNED NOT NULL ,
  `quantity` FLOAT NULL ,
  `recipe_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`, `recipe_id`) ,
  CONSTRAINT `fk_nutrition_entry_nutrition1`
    FOREIGN KEY (`nutrition_id` )
    REFERENCES `phprecipedb`.`nutrition` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_nutrition_entry_unit1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `phprecipedb`.`unit` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_nutrition_entry_recipe1`
    FOREIGN KEY (`recipe_id` )
    REFERENCES `phprecipedb`.`recipe` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;

CREATE UNIQUE INDEX `id_UNIQUE` ON `phprecipedb`.`nutrition_entry` (`id` ASC) ;

CREATE INDEX `fk_nutrition_entry_nutrition1` ON `phprecipedb`.`nutrition_entry` (`nutrition_id` ASC) ;

CREATE INDEX `fk_nutrition_entry_unit1` ON `phprecipedb`.`nutrition_entry` (`unit_id` ASC) ;

CREATE INDEX `fk_nutrition_entry_recipe1` ON `phprecipedb`.`nutrition_entry` (`recipe_id` ASC) ;


-- -----------------------------------------------------
-- Table `phprecipedb`.`attribute`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`attribute` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`attribute` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(40) NOT NULL ,
  PRIMARY KEY (`id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;

CREATE UNIQUE INDEX `id_unique` ON `phprecipedb`.`attribute` (`id` ASC) ;


-- -----------------------------------------------------
-- Table `phprecipedb`.`course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`course` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`course` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(40) NOT NULL ,
  PRIMARY KEY (`id`) );

CREATE UNIQUE INDEX `id_UNIQUE` ON `phprecipedb`.`course` (`id` ASC) ;


-- -----------------------------------------------------
-- Table `phprecipedb`.`recipe_has_attribute`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`recipe_has_attribute` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`recipe_has_attribute` (
  `recipe_id` INT UNSIGNED NOT NULL ,
  `attribute_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`recipe_id`, `attribute_id`) ,
  CONSTRAINT `fk_tbl_recipe_has_tbl_attribute_tbl_recipe`
    FOREIGN KEY (`recipe_id` )
    REFERENCES `phprecipedb`.`recipe` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_recipe_has_tbl_attribute_tbl_attribute`
    FOREIGN KEY (`attribute_id` )
    REFERENCES `phprecipedb`.`attribute` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);

CREATE INDEX `fk_tbl_recipe_has_tbl_attribute_tbl_attribute` ON `phprecipedb`.`recipe_has_attribute` (`attribute_id` ASC) ;


-- -----------------------------------------------------
-- Table `phprecipedb`.`recipe_has_course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phprecipedb`.`recipe_has_course` ;

CREATE  TABLE IF NOT EXISTS `phprecipedb`.`recipe_has_course` (
  `recipe_id` INT UNSIGNED NOT NULL ,
  `course_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`recipe_id`, `course_id`) ,
  CONSTRAINT `fk_recipe_has_course_recipe`
    FOREIGN KEY (`recipe_id` )
    REFERENCES `phprecipedb`.`recipe` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_recipe_has_course_course`
    FOREIGN KEY (`course_id` )
    REFERENCES `phprecipedb`.`course` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE);

CREATE INDEX `fk_recipe_has_course_course` ON `phprecipedb`.`recipe_has_course` (`course_id` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `phprecipedb`.`course`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `phprecipedb`;
INSERT INTO `phprecipedb`.`course` (`id`, `description`) VALUES ('1', 'Vorspeise');
INSERT INTO `phprecipedb`.`course` (`id`, `description`) VALUES ('2', 'Hauptspeise');
INSERT INTO `phprecipedb`.`course` (`id`, `description`) VALUES ('3', 'Nachspeise');
INSERT INTO `phprecipedb`.`course` (`id`, `description`) VALUES ('4', 'Suppe');
INSERT INTO `phprecipedb`.`course` (`id`, `description`) VALUES ('5', 'Kuchen und Gebäck');
INSERT INTO `phprecipedb`.`course` (`id`, `description`) VALUES ('6', 'Brot und Brötchen');
INSERT INTO `phprecipedb`.`course` (`id`, `description`) VALUES ('7', 'Zwischengang');
INSERT INTO `phprecipedb`.`course` (`id`, `description`) VALUES ('8', 'Salat');

COMMIT;
