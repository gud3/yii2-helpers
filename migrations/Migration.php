<?php

namespace gud3\helpers\migrations;

/**
 * Class Migration
 *
 * @package gud3\helpers\migrations
 */
class Migration extends \yii\db\Migration
{
    /**
     * @param string $table
     * @param array  $columns
     * @param null   $options
     */
    public function createTable($table, $columns, $options = null)
    {
        if ($options === null) {
            if ($this->db->driverName === 'mysql') {
                $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
        }

        parent::createTable($table, $columns, $options);
    }
}