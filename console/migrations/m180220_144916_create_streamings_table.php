<?php

use yii\db\Migration;

/**
 * Handles the creation of table `streamings`.
 */
class m180220_144916_create_streamings_table extends Migration
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

      $this->createTable('{{streamings}}', [
          'id'            => $this->primaryKey(),
          'title'         => $this->string(100)->notNull(),
          'description'   => $this->text()->notNull(),
          'embed'         => $this->string(255),
          'start'         => $this->dateTime()->notNull(),
          'end'           => $this->dateTime()->notNull(),
          'created_by'    => $this->integer()->notNull(),
          'created_at'    => $this->dateTime()->notNull(),
          'updated_by'    => $this->integer()->notNull(),
          'updated_at'    => $this->dateTime()->notNull(),
      ], $tableOptions);

      $this->addForeignKey(
          'usercreatestreaming', 'streamings', 'created_by', 'users', 'id', 'no action', 'no action'
      );

      $this->addForeignKey(
          'userupdatestreaming', 'streamings', 'updated_by', 'users', 'id', 'no action', 'no action'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('usercreatestreaming', 'streamings');
      $this->dropForeignKey('userupdatestreaming', 'streamings');
      $this->dropTable('streamings');
    }
}
