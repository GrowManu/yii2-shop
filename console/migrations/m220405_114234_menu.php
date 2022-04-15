<?php

use yii\db\Migration;

/**
 * Class m220405_114234_menu
 */
class m220405_114234_menu extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'url' => $this->string(50)->notNull(),
            'text' => $this->string(1000),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "m220405_114234_menu cannot be reverted.\n";

        return false;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m220405_114234_menu cannot be reverted.\n";

      return false;
      }
     */
}
