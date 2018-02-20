<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m180220_144945_create_comments_table extends Migration
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

      $this->createTable('{{comments}}', [
          'id'            => $this->primaryKey(),
          'name'          => $this->string(150)->notNull(),
          'email'         => $this->string(100)->notNull(),
          'web'           => $this->string(100),
          'rel'           => $this->string(20),
          'comment'       => $this->text()->notNull(),
          'date'          => $this->dateTime()->notNull(),
          'article_id'    => $this->integer()->notNull(),
          'status'        => $this->boolean()->defaultValue(false)->notNull(),
          'client_ip'     => $this->string(15),
          'client_port'   => $this->string(5)
      ], $tableOptions);

      $this->addForeignKey(
          'articlecomment', 'comments', 'article_id', 'articles', 'id', 'no action', 'no action'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('articlecomment', 'comments');
      $this->dropTable('comments');
    }
}
