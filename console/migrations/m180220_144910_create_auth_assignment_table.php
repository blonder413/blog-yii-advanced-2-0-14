<?php

use yii\db\Migration;

/**
 * Handles the creation of table `auth_assignment`.
 */
class m180220_144910_create_auth_assignment_table extends Migration
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

      $this->createTable('{{auth_assignment}}', [
          'item_name'     => $this->string(64)->notNull(),
          'user_id'       => $this->string(64)->notNull(),
          'created_at'    => $this->integer(),
      ], $tableOptions);

      $this->addPrimaryKey('auth_assignment_pk', 'auth_assignment', ['item_name', 'user_id']);

      $this->addForeignKey(
          'item_name_auth_assignment_fk', 'auth_assignment', 'item_name', 'auth_item', 'name', 'cascade', 'cascade'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth_assignment');
    }
}
