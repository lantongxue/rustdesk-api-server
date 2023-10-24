<?php

use yii\db\Migration;

/**
 * Class m231023_092000_users
 */
class m231023_092000_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->unique(),
            'password' => $this->string(),
            'name' => $this->string(),
            'email' => $this->string(),
            'note' => $this->string(),
            'status' => $this->tinyInteger(1),//->comment('0=disabled, -1=unverified, others=normal'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231023_092000_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231023_092000_users cannot be reverted.\n";

        return false;
    }
    */
}
