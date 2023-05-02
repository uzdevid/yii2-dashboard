<?php

use yii\db\Migration;

/**
 * Class m230502_072026_device
 */
class m230502_072026_device extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void {
        $this->createTable('device', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'name' => $this->string(255)->notNull(),
            'device_id' => $this->string(255)->notNull(),
            'access_token' => $this->string(255)->notNull(),
            'type' => $this->string(32)->notNull(),
            'last_activity_time' => $this->bigInteger(16)->notNull(),
            'authorization_time' => $this->bigInteger(16)->notNull(),
        ]);

        $this->addForeignKey('fk_device_user_id', 'device', 'user_id', 'user', 'id', 'CASCADE', 'NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): bool {
        $this->dropTable('device');
        return true;
    }
}
