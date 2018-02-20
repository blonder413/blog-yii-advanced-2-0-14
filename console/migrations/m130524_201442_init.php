<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_spanish_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%users}}', [
          'id'                    => $this->primaryKey(),
          'name'                  => $this->string()->notNull(),
          'username'              => $this->string()->notNull()->unique(),
          'auth_key'              => $this->string(32)->notNull(),
          'password_hash'         => $this->string()->notNull(),
          'password_reset_token'  => $this->string()->unique(),
          'email'                 => $this->string()->notNull()->unique(),
          'photo'                 => $this->string()->notNull()->unique(),
          'status'                => $this->smallInteger()->notNull()->defaultValue(10),
          'created_at'            => $this->dateTime(),
          'updated_at'            => $this->dateTime(),
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%users}}');
    }
}