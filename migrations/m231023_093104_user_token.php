<?php

use yii\db\Migration;

/**
 * Class m231023_093104_user_token
 */
class m231023_093104_user_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'my_id' => $this->string(),
            'uuid' => $this->string(),
            'token' => $this->string(),
            'expired' => $this->dateTime(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231023_093104_user_token cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231023_093104_user_token cannot be reverted.\n";

        return false;
    }
    */
}
