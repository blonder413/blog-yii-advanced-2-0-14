<?php

use yii\db\Migration;

/**
 * Handles the creation of table `types`.
 */
class m180220_144927_create_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_spanish_ci ENGINE=InnoDB';
      }

      $this->createTable('{{types}}', [
          'id'            => $this->primaryKey(),
          'type'          => $this->string(50)->notNull(),
          'created_by'    => $this->integer()->notNull(),
          'created_at'    => $this->dateTime()->notNull(),
          'updated_by'    => $this->integer()->notNull(),
          'updated_at'    => $this->dateTime()->notNull(),
      ], $tableOptions);

      $this->addForeignKey(
          'usercreatetype', 'types', 'created_by', 'users', 'id', 'no action', 'no action'
      );

      $this->addForeignKey(
          'userupdatetype', 'types', 'updated_by', 'users', 'id', 'no action', 'no action'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('usercreatetype', 'types');
      $this->dropForeignKey('userupdatetype', 'types');
      $this->dropTable('types');
    }
}
