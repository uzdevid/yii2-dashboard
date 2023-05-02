<?php

use yii\db\Migration;

/**
 * Class m230502_072037_contact
 */
class m230502_072037_contact extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void {
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'type' => $this->string(255)->notNull(),
            'contact' => $this->string(255)->notNull(),
        ]);

        $this->addForeignKey('fk_contact_user_id', 'contact', 'user_id', 'user', 'id', 'CASCADE', 'NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('contact');
        return true;
    }
}
