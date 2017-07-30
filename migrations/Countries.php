<?php

use yii\db\Migration;

/**
 * Class Countries
 */
class Countries extends Migration
{
    /**
     * safe up migration
     */
    public function safeUp()
    {
        $tableOptions = null;
        if (!empty($this->db->getTableSchema('{{%countries}}'))) {
            return true;
        }

        $file = file_get_contents(__DIR__.'/countries/countries.csv');
        $explodedCSV = explode("\n", $file);
        $countries = [];
        foreach ($explodedCSV as $csv) {
            $countries[] = explode(',', $csv);
        }
        if (empty($countries)) {
            return false;
        }
        //first is column name
        unset($countries[0]);
        foreach ($countries as $country) {
            if (empty($country[0]) || empty($country[1])) {
                continue;
            }
            $this->insert('{{%countries}}', [
                'code' => $country[0],
                'name' => $country[1],
            ]);
        }
    }

    /**
     * safe down migration
     */
    public function safeDown()
    {
        if (empty($this->db->getTableSchema('{{%countries}}'))) {
            return true;
        }
        $this->dropTable('{{%countries}}');
    }
}
