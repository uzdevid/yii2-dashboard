<?php

use yii\db\Migration;

/**
 * Class m230502_071811_role
 */
class m230502_071811_role extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
        ]);

        $this->insert('role', ['name' => 'admin']);
        $this->insert('role', ['name' => 'manager']);
        $this->insert('role', ['name' => 'editor']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): bool {
        $this->dropTable('role');
        return true;
    }
}
