<?php

class m111002_054611_phonetics extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $lAllIngredient = array();
        /**
         * update ingredient table
         */
        $this
            ->addColumn(
                'tbl_ingredient',
                'cologne_phony_code',
                'VARCHAR(64) COMMENT "cologne phonetic key"'
        );
        $this
            ->addColumn(
                'tbl_ingredient',
                'soundex_code',
                'VARCHAR(4) COMMENT "soundex key"');

        $lAllIngredient = $this->getDbConnection()->createCommand()
            ->select('id,name')->from('tbl_ingredient')->queryAll();

        foreach ($lAllIngredient as $i) {
            echo $i['name'] . '  ' . Utilities::germanphonetic($i['name'])
                . '  ' . soundex($i['name']) . "\n";
            $this
                ->update(
                    'tbl_ingredient',
                    array(
                            'cologne_phony_code' => Utilities::germanphonetic(
                                $i['name']),
                            'soundex_code' => soundex($i['name'])),
                    "id = " . $i['id']);
        }

        $this
            ->alterColumn(
                'tbl_ingredient',
                'cologne_phony_code',
                'VARCHAR(64) NOT NULL COMMENT "cologne phonetic key"');
        $this
            ->alterColumn(
                'tbl_ingredient',
                'soundex_code',
                'VARCHAR(4) NOT NULL COMMENT "soundex key"');
        echo "done.";
    }

    public function safeDown()
    {
        $this->dropColumn('tbl_ingredient', 'cologne_phony_code');
        $this->dropColumn('tbl_ingredient', 'soundex_code');
    }
}
