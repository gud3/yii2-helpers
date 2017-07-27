<?php

namespace gud3\helpers\migrations;

use yii\db\Migration;

/**
 * Class Indexes
 * @package console\migrations
 */
class Indexes extends Migration
{
    const FLAG_CREATE = 'create';
    const FLAG_DROP = 'drop';

    protected $indexes = [];

    /**
     * up migration
     */
    public function up()
    {
        $this->createOrDrop(self::FLAG_CREATE);
    }

    /**
     * down migration
     */
    public function down()
    {
        $this->createOrDrop(self::FLAG_DROP);
    }

    /**
     * @param $flag
     */
    private function createOrDrop($flag)
    {
        foreach($this->indexes as $key => $columns) {
            $table = key($columns);
            $column = $columns[$table];

            if (is_array($column)) {
                foreach ($column as $col) {
                    $this->set($flag, $table, $col);
                }
            } else {
                $this->set($flag, $table, $column);
            }
        }
    }

    /**
     * @param $flag
     * @param $table
     * @param $column
     */
    private function set($flag, $table, $column)
    {
        if (empty($this->db->getTableSchema($table)) || empty($this->db->getTableSchema($table)->getColumn($column))) {
            return;
        }

        $index = 'IN_' . $table . '_' . $column;

        if ($flag == self::FLAG_CREATE) {
            $this->createIndex($index, $table, $column);
        } else if ($flag == self::FLAG_DROP) {
            $this->dropIndex($index, $table);
        }
    }
}