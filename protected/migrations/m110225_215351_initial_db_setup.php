<?php

/*
 * migration script for initial database setup
 */

class m110225_215351_initial_db_setup
        extends CDbMigration
{

    public function safeUp()
    {
        /**
         * create unit type table
         */
        $this
                ->createTable('tbl_unit_type', array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                    'name' => 'VARCHAR(64) NOT NULL',
                        ), 'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');
        /**
         * create ingrediet table
         */
        $this
                ->createTable('tbl_ingredient', array('id' => 'INT NOT NULL AUTO_INCREMENT COMMENT "private key of ingredient"', 'id' => 'pk',
                    'name' => 'VARCHAR(64) NOT NULL COMMENT "name of ingredient"',
                    'unit_usage' => 'BIT(4)NULL COMMENT "bit field for allowed usage types (base types only)\n0 bit: weight\n1 bit: liquid\n2 bit: pieces\n4bit: something else"',
                    'cologne_phony_code' => 'VARCHAR(64) NOT NULL COMMENT "cologne phonetic key"',
                    'soundex_code' => 'VARCHAR(4) NOT NULL COMMENT "soundex key"',
                        ), 'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        /**
         * create unit table
         */
        $this
                ->createTable('tbl_unit', array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                    'short_desc' => 'VARCHAR(20) NOT NULL',
                    'description' => 'VARCHAR(64) NOT NULL',
                    'unit_type_id' => 'INT NOT NULL', 'is_base_unit' => 'BOOL',
                    'base_unit_factor' => 'FLOAT NOT NULL'
                        ), 'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
                ->addForeignKey('fk_unit_unit_type', 'tbl_unit', 'unit_type_id', 'tbl_unit_type', 'id', 'RESTRICT', 'CASCADE');

        /**
         * create recipe table
         */
        $this
                ->createTable('tbl_recipe', array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                    'name' => 'VARCHAR(64) NOT NULL',
                    'description' => 'VARCHAR(256) NOT NULL',
                    'quantity' => 'FLOAT NULL', 'unit_id' => 'INT NOT NULL',
                        ), 'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
                ->addForeignKey('fk_recipe_unit', 'tbl_recipe', 'unit_id', 'tbl_unit', 'id', 'RESTRICT', 'CASCADE');

        /**
         * create preparation step table
         */
        $this
                ->createTable('tbl_preparation_step', array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                    'name' => 'VARCHAR(64) NOT NULL',
                    'description' => 'VARCHAR(256) NOT NULL',
                    'recipe_id' => 'INT NOT NULL',
                        ), 'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
                ->addForeignKey('fk_preparation_step_recipe', 'tbl_preparation_step', 'recipe_id', 'tbl_recipe', 'id', 'RESTRICT', 'CASCADE');

        /**
         * create ingredient section table
         */
        $this
                ->createTable('tbl_ingredient_section', array('id' => 'INT NOT NULL AUTO_INCREMENT', 'id' => 'pk',
                    'name' => 'VARCHAR(64) NOT NULL',
                    'seq_no' => 'INT NOT NULL', 'recipe_id' => 'INT NOT NULL',
                        ), 'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
                ->addForeignKey('fk_ingredient_section_recipe', 'tbl_ingredient_section', 'recipe_id', 'tbl_recipe', 'id', 'RESTRICT', 'CASCADE');

        /**
         * create ingredient entry table
         */
        $this
                ->createTable('tbl_ingredient_entry', array('id' => 'INT NOT NULL AUTO_INCREMENT',
                    'ingredient_section_id' => 'INT NOT NULL',
                    'ingredient_section_recipe_id' => 'INT NOT NULL',
                    'PRIMARY KEY (`id`, `ingredient_section_id`, `ingredient_section_recipe_id`)',
                    'ingredient_id' => 'INT NOT NULL',
                    'quantity' => 'FLOAT NULL', 'unit_id' => 'INT NOT NULL',
                        ), 'ENGINE=InnoDB DEFAULT CHARSET = UTF8 COLLATE utf8_general_ci');

        $this
                ->addForeignKey('fk_ingredient_entry_ingredient_section', 'tbl_ingredient_entry', 'ingredient_section_id', 'tbl_ingredient_section', 'id', 'RESTRICT', 'CASCADE');
        $this
                ->addForeignKey('fk_ingredient_entry_ingredient', 'tbl_ingredient_entry', 'ingredient_id', 'tbl_ingredient', 'id', 'RESTRICT', 'CASCADE');
        $this
                ->addForeignKey('fk_ingredient_entry_unit', 'tbl_ingredient_entry', 'unit_id', 'tbl_unit', 'id', 'RESTRICT', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('tbl_ingredient_entry');
        $this->dropTable('tbl_ingredient_section');
        $this->dropTable('tbl_preparation_step');
        $this->dropTable('tbl_recipe');
        $this->dropTable('tbl_unit');
        $this->dropTable('tbl_ingredient');
        $this->dropTable('tbl_unit_type');
    }

}
