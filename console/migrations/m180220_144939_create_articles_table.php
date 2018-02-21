<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articles`.
 */
class m180220_144939_create_articles_table extends Migration
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

      $this->createTable('{{articles}}', [
          'id'                => $this->primaryKey(),
          'number'            => $this->smallInteger(),
          'title'             => $this->string(150)->notNull()->unique(),
          'slug'              => $this->string(150)->notNull(),
          'topic'             => $this->string(100),
          'detail'            => $this->text()->notNull(),
          'abstract'          => $this->string(300)->notNull(),
          'video'             => $this->string(255),
          'type_id'           => $this->integer()->notNull(),
          'download'          => $this->string(100),
          'category_id'       => $this->integer()->notNull(),
          'tags'              => $this->string(255)->notNull(),
          'status'            => $this->boolean()->notNull(),
          'visit_counter'     => $this->integer()->defaultValue(0)->notNull(),
          'download_counter'  => $this->integer()->defaultValue(0)->notNull(),
          'course_id'         => $this->integer(),
          'created_by'        => $this->integer()->notNull(),
          'created_at'        => $this->dateTime()->notNull(),
          'updated_by'        => $this->integer()->notNull(),
          'updated_at'        => $this->dateTime()->notNull(),
      ], $tableOptions);

      $this->addForeignKey(
          'categoryarticle', 'articles', 'category_id', 'categories', 'id', 'no action', 'no action'
      );

      $this->addForeignKey(
          'coursearticle', 'articles', 'course_id', 'courses', 'id', 'no action', 'no action'
      );

      $this->addForeignKey(
          'typearticle', 'articles', 'type_id', 'types', 'id', 'no action', 'no action'
      );

      $this->addForeignKey(
          'usercreatearticle', 'articles', 'created_by', 'users', 'id', 'no action', 'no action'
      );

      $this->addForeignKey(
          'userupdatearticle', 'articles', 'updated_by', 'users', 'id', 'no action', 'no action'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('categoryarticle', 'articles');
      $this->dropForeignKey('coursearticle', 'articles');
      $this->dropForeignKey('typearticle', 'articles');
      $this->dropForeignKey('usercreatearticle', 'articles');
      $this->dropForeignKey('userupdatearticle', 'articles');
      $this->dropTable('articles');
    }
}
