<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m180220_144922_create_categories_table extends Migration
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

      $this->createTable('{{categories}}', [
          'id'            => $this->primaryKey(),
          'category'      => $this->string(100)->notNull(),
          'slug'          => $this->string(100)->notNull(),
          'description'   => $this->string(255),
          'image'         => $this->string(50),
          'created_by'    => $this->integer()->notNull(),
          'created_at'    => $this->dateTime()->notNull(),
          'updated_by'    => $this->integer()->notNull(),
          'updated_at'    => $this->dateTime()->notNull(),
      ], $tableOptions);

      $this->addForeignKey(
          'usercreatecategory', 'categories', 'created_by', 'users', 'id', 'no action', 'no action'
      );

      $this->addForeignKey(
          'userupdatecategory', 'categories', 'updated_by', 'users', 'id', 'no action', 'no action'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('usercreatecategory', 'categories');
      $this->dropForeignKey('userupdatecategory', 'categories');
      $this->dropTable('categories');
    }
}
