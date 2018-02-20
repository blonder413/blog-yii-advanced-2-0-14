<?php

use yii\db\Migration;

/**
 * Handles the creation of table `auth_item`.
 */
class m180220_144859_create_auth_item_table extends Migration
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

      $this->createTable('{{auth_item}}', [
          'name'          => $this->string(64)->notNull(),
          'type'          => $this->integer()->notNull(),
          'description'   => $this->text(),
          'rule_name'     => $this->string(64),
          'data'          => $this->text(),
          'created_at'    => $this->integer(),
          'updated_at'    => $this->integer(),
      ], $tableOptions);

      $this->addPrimaryKey('auth_item_name', 'auth_item', 'name');

      $this->addForeignKey(
          'auth_item_rule_name_name', 'auth_item', 'rule_name', 'auth_rule', 'name', 'set null', 'cascade'
      );

      $this->createIndex('type_auth_item', 'auth_item', 'type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth_item');
    }
}
