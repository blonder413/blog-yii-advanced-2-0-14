<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sessions`.
 */
class m180224_190957_create_sessions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('{{%sessions}}', [
          'id' => $this->char(64)->notNull(),
          'expire' => $this->integer(),
          'data' => $this->binary()
      ]);
      $this->addPrimaryKey('pk-id', '{{%sessions}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sessions}}');
    }
}
