<?php

use yii\db\Migration;

/**
 * Class m231024_161038_tags
 */
class m231024_161038_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tags}}',[
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'tag' => $this->string(),
            'color' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231024_161038_tags cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231024_161038_tags cannot be reverted.\n";

        return false;
    }
    */
}
