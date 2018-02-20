<?php

use yii\db\Migration;

/**
 * Handles the creation of table `courses`.
 */
class m180220_144934_create_courses_table extends Migration
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

      $this->createTable('{{courses}}', [
          'id'            => $this->primaryKey(),
          'course'        => $this->string(100)->notNull()->unique(),
          'slug'          => $this->string(100)->notNull()->unique(),
          'description'   => $this->text()->notNull(),
          'image'         => $this->string(50)->notNull(),
          'created_by'    => $this->integer()->notNull(),
          'created_at'    => $this->dateTime()->notNull(),
          'updated_by'    => $this->integer()->notNull(),
          'updated_at'    => $this->dateTime()->notNull(),
      ], $tableOptions);

      $this->addForeignKey(
          'usercreatecourse', 'courses', 'created_by', 'users', 'id', 'no action', 'no action'
      );

      $this->addForeignKey(
          'userupdatecourse', 'courses', 'updated_by', 'users', 'id', 'no action', 'no action'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('usercreatecourse', 'courses');
      $this->dropForeignKey('userupdatecourse', 'courses');
      $this->dropTable('courses');
    }
}
