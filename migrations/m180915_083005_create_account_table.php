<?php

use yii\db\Migration;

/**
 * Handles the creation of table `account`.
 */
class m180915_083005_create_account_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('account', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(150) UNIQUE NOT NULL',
            'balance' => 'DECIMAL(6,2) DEFAULT 0'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('account');
    }
}
