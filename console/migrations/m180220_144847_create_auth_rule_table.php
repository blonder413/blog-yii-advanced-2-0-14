<?php

use yii\db\Migration;

/**
 * Handles the creation of table `auth_rule`.
 */
class m180220_144847_create_auth_rule_table extends Migration
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

      $this->createTable('{{auth_rule}}', [
          'name'          => $this->string(64)->notNull(),
          'data'          => $this->text(),
          'created_at'    => $this->integer(),
          'updated_at'    => $this->integer(),
      ], $tableOptions);

      $this->addPrimaryKey('auth_rule_name', 'auth_rule', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth_rule');
    }
}
