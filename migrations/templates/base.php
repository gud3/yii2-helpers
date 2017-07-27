<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use yii\db\Migration;

/**
 * Class <?= $className ?> <?="\n"?>
 */
class <?= $className ?> extends Migration
{
    /**
     * safe up migration
     */
    public function safeUp()
    {
        $tableOptions = null;
        if (!empty($this->db->getTableSchema('{{%<?= $name ?>}}'))) {
            return true;
        }
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%<?= $name ?>}}', [
            'id' => $this->primaryKey(),

        ], $tableOptions);

        //$this->addForeignKey('FK_<?= $name ?>', '{{%<?= $name ?>}}', '', '{{%}}', '', 'CASCADE', 'CASCADE');
    }

    /**
     * safe down migration
     */
    public function safeDown()
    {
        if (!empty($this->db->getTableSchema('{{%<?= $name ?>}}'))) {
            //$this->dropForeignKey('FK_<?= $name ?>', '{{%<?= $name ?>}}');
            $this->dropTable('{{%<?= $name ?>}}');
        }
    }
}
