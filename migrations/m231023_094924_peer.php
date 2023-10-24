<?php

use yii\db\Migration;

/**
 * Class m231023_094924_peers
 */
class m231023_094924_peer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%peer}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'peer_id' => $this->string(),
            'hash' => $this->string(),
            'username' => $this->string(),
            'hostname' => $this->string(),
            'platform' => $this->string(),
            'alias' => $this->string(),
            'tags' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231023_094924_peers cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231023_094924_peers cannot be reverted.\n";

        return false;
    }
    */
}
