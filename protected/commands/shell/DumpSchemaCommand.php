<?php

class DumpSchemaCommand extends CConsoleCommand
{

    public function run($args)
    {
        $schema = $args[0];
        $tables = Yii::app()->db->schema->getTables($schema);
        $result = '';
        /*
         *
        // CREO LA TABELLA PARENT

        $this->createTable('parent', array(
                        'id'=>'int(10) NOT NULL AUTO_INCREMENT',
                        'id'=>'pk', // Imposto chiave primaria
        ),'ENGINE=InnoDB');

        // CREO LA TABELLA CHILD

        $this->createTable('child', array(
                        'id'=>'int(10) NOT NULL',
                        'parent_id'=>'int(10)',
                        'INDEX par_ind (parent_id)',// Imposto l'indice che uso per la relazione con la tabella parent
        ),'ENGINE=InnoDB');

        // INSERISCO DATI NELLA TABELLA PARENT

        $this->insert('parent', array(
                        'id'=>1,
        ));

        // INSERISCO DATI NELLA TABELLA CHILD

        $this->insert('child', array(
                        'id'=>1,
                        'parent_id'=>1,
        ));
        //
         * Builds a SQL statement for adding a foreign key constraint to an existing table.
         * The method will properly quote the table and column names.
         * @param string $name the name of the foreign key constraint.
         * @param string $table the table that the foreign key constraint will be added to.
         * @param string $columns the name of the column to that the constraint
         * will be added on. If there are multiple columns, separate them with commas.
         * @param string $refTable the table that the foreign key references to.
         * @param string $refColumns the name of the column that the foreign key
         * references to. If there are multiple columns, separate them with commas.
         * @param string $delete the ON DELETE option. Most DBMS support these
         * options: RESTRICT, CASCADE, NO ACTION, SET DEFAULT, SET NULL
         * @param string $update the ON UPDATE option. Most DBMS support these
         * options: RESTRICT, CASCADE, NO ACTION, SET DEFAULT, SET NULL
        //

        $this->addForeignKey('par_ind','child','parent_id','parent','id',
        'CASCADE','CASCADE');
         */

        foreach ($tables as $def) {
            $result .= '$this->createTable("' . $def->name . '", array(' . "\n";
            foreach ($def->columns as $col) {
                $result .= '    "' . $col->name . '"=>"'
                    . $this->getColType($col) . '",' . "\n";
            }
            $result .= '), \'ENGINE=InnoDB\');' . "\n\n";
        }
        echo $result;

        // add foreign keys
        // $this->addForeignKey('par_ind','child','parent_id','parent','id',
        // 'CASCADE','CASCADE');

        var_dump(Yii::app()->db->schema);
    }

    public function getColType($col)
    {
        if ($col->isPrimaryKey) {
            return "pk";
        }
        $result = $col->dbType;
        if (!$col->allowNull) {
            $result .= ' NOT NULL';
        }
        if ($col->defaultValue != null) {
            $result .= " DEFAULT '{$col->defaultValue}'";
        }
        return $result;
    }
}
