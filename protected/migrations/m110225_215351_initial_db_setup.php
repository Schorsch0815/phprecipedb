<?php

/*
 * migration script for initial database setup
 */

class m110225_215351_initial_db_setup extends CDbMigration
{

    public function safeUp()
    {
        /**
         * create unit type table
         */
        $this
            ->createTable(
                'tbl_unit_type',
                array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                        'name' => 'VARCHAR(64) NOT NULL',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');
        /**
         * create ingrediet table
         */
        $this
            ->createTable(
                'tbl_ingredient',
                array(
                        'id' => 'INT NOT NULL AUTO_INCREMENT COMMENT "private key of ingredient"',
                        'id' => 'pk',
                        'name' => 'VARCHAR(64) NOT NULL COMMENT "name of ingredient"',
                        'unit_usage' => 'BIT(4)NULL COMMENT "bit field for allowed usage types (base types only)\n0 bit: weight\n1 bit: liquid\n2 bit: pieces\n4bit: something else"',
                        'cologne_phony_code' => 'VARCHAR(64) NOT NULL COMMENT "cologne phonetic key"',
                        'soundex_code' => 'VARCHAR(4) NOT NULL COMMENT "soundex key"',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        /**
         * create unit table
         */
        $this
            ->createTable(
                'tbl_unit',
                array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                        'short_desc' => 'VARCHAR(20) NOT NULL',
                        'description' => 'VARCHAR(64) NOT NULL',
                        'unit_type_id' => 'INT NOT NULL',
                        'is_base_unit' => 'BOOL',
                        'base_unit_factor' => 'FLOAT NOT NULL'),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
            ->addForeignKey(
                'fk_unit_unit_type',
                'tbl_unit',
                'unit_type_id',
                'tbl_unit_type',
                'id',
                'RESTRICT',
                'CASCADE');

        /**
         * create recipe table
         */
        $this
            ->createTable(
                'tbl_recipe',
                array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                        'name' => 'VARCHAR(64) NOT NULL',
                        'description' => 'VARCHAR(256) NOT NULL',
                        'quantity' => 'FLOAT NULL',
                        'unit_id' => 'INT NOT NULL',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
            ->addForeignKey(
                'fk_recipe_unit',
                'tbl_recipe',
                'unit_id',
                'tbl_unit',
                'id',
                'RESTRICT',
                'CASCADE');

        /**
         * create preparation section table
         */
        $this
            ->createTable(
                'tbl_preparation_section',
                array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                        'name' => 'VARCHAR(64)',
                        'description' => 'VARCHAR(256) NOT NULL',
                        'seq_no' => 'INT NOT NULL',
                        'recipe_id' => 'INT NOT NULL',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
            ->addForeignKey(
                'fk_preparation_section_recipe',
                'tbl_preparation_section',
                'recipe_id',
                'tbl_recipe',
                'id',
                'RESTRICT',
                'CASCADE');

        /**
         * create ingredient section table
         */
        $this
            ->createTable(
                'tbl_ingredient_section',
                array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                        'name' => 'VARCHAR(64)', 'seq_no' => 'INT NOT NULL',
                        'recipe_id' => 'INT NOT NULL',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
            ->addForeignKey(
                'fk_ingredient_section_recipe',
                'tbl_ingredient_section',
                'recipe_id',
                'tbl_recipe',
                'id',
                'RESTRICT',
                'CASCADE');

        /**
         * create ingredient entry table
         */
        $this
            ->createTable(
                'tbl_ingredient_entry',
                array('id' => 'INT NOT NULL AUTO_INCREMENT',
                        'ingredient_section_id' => 'INT NOT NULL',
                        'ingredient_section_recipe_id' => 'INT NOT NULL',
                        'PRIMARY KEY (`id`, `ingredient_section_id`, `ingredient_section_recipe_id`)',
                        'ingredient_id' => 'INT NOT NULL',
                        'quantity' => 'FLOAT NULL',
                        'unit_id' => 'INT NOT NULL',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
            ->addForeignKey(
                'fk_ingredient_entry_ingredient_section',
                'tbl_ingredient_entry',
                'ingredient_section_id',
                'tbl_ingredient_section',
                'id',
                'RESTRICT',
                'CASCADE');
        $this
            ->addForeignKey(
                'fk_ingredient_entry_ingredient',
                'tbl_ingredient_entry',
                'ingredient_id',
                'tbl_ingredient',
                'id',
                'RESTRICT',
                'CASCADE');
        $this
            ->addForeignKey(
                'fk_ingredient_entry_unit',
                'tbl_ingredient_entry',
                'unit_id',
                'tbl_unit',
                'id',
                'RESTRICT',
                'CASCADE');

        /**
         * create attribute table
         */
        $this
        ->createTable(
                'tbl_attribute',
                array('id' => 'INT NOT NULL AUTO_INCREMENT',
                        'PRIMARY KEY (`id`)',
                        'description' => 'VARCHAR(40) NOT NULL',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        /**
         * create recipe has attribute table
         */
        $this
        ->createTable(
                'tbl_recipe_has_attribute',
                array('recipe_id' => 'INT NOT NULL',
                        'attribute_id' => 'INT NOT NULL',
                        'PRIMARY KEY (`recipe_id`, `attribute_id`)',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
        ->addForeignKey(
                'fk_recipe_has_attribute_attribute',
                'tbl_recipe_has_attribute',
                'attribute_id',
                'tbl_attribute',
                'id',
                'RESTRICT',
                'CASCADE');

        /**
         * create course table
         */
        $this
        ->createTable(
                'tbl_course',
                array('id' => 'INT NOT NULL AUTO_INCREMENT',
                        'PRIMARY KEY (`id`)',
                        'description' => 'VARCHAR(40) NOT NULL',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');


        /**
         * create recipe has course table
         */
        $this
        ->createTable(
                'tbl_recipe_is_course',
                array('recipe_id' => 'INT NOT NULL',
                        'course_id' => 'INT NOT NULL',
                        'PRIMARY KEY (`recipe_id`, `course_id`)',),
                'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
        ->addForeignKey(
                'fk_recipe_is_course_recipe',
                'tbl_recipe_is_course',
                'course_id',
                'tbl_course',
                'id',
                'RESTRICT',
                'CASCADE');

/*
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

*/
    }

    public function safeDown()
    {
        $this->dropTable('tbl_recipe_is_course');
        $this->dropTable('tbl_recipe_has_attribute');
        $this->dropTable('tbl_course');
        $this->dropTable('tbl_attribute');
        $this->dropTable('tbl_ingredient_entry');
        $this->dropTable('tbl_ingredient_section');
        $this->dropTable('tbl_preparation_section');
        $this->dropTable('tbl_recipe');
        $this->dropTable('tbl_unit');
        $this->dropTable('tbl_ingredient');
        $this->dropTable('tbl_unit_type');
    }

}
