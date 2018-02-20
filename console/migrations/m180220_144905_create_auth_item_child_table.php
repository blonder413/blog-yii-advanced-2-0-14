<?php

use yii\db\Migration;

/**
 * Handles the creation of table `auth_item_child`.
 */
class m180220_144905_create_auth_item_child_table extends Migration
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

      $this->createTable('{{auth_item_child}}', [
          'parent'    => $this->string(64)->notNull(),
          'child'     => $this->string(64)->notNull(),
      ], $tableOptions);

      $this->addPrimaryKey('parent_chile_auth_item_child', 'auth_item_child', ['parent', 'child']);

      $this->addForeignKey(
          'parent_auth_item_child', 'auth_item_child', 'parent', 'auth_item', 'name', 'cascade', 'cascade'
      );

      $this->addForeignKey(
          'child_auth_item_child', 'auth_item_child', 'child', 'auth_item', 'name', 'cascade', 'cascade'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth_item_child');
    }
}
