<?php

use yii\db\Migration;

/**
 * Class m230502_071844_menu
 */
class m230502_071844_menu extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'role_id' => $this->integer(11)->null()->defaultValue(1),
            'parent_id' => $this->integer(11)->null(),
            'icon' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'link' => $this->string(255)->notNull(),
            'order' => $this->integer(11)->notNull(),
        ]);

        $this->addForeignKey('fk_menu_role_id', 'menu', 'role_id', 'role', 'id', 'SET NULL', 'NO ACTION');
        $this->addForeignKey('fk_menu_parent_id', 'menu', 'parent_id', 'menu', 'id', 'SET NULL', 'NO ACTION');

        $this->batchInsert('menu',
            ['id', 'role_id', 'parent_id', 'icon', 'title', 'link', 'order'],
            [
                ['id' => 1, 'role_id' => 1, 'parent_id' => null, 'icon' => 'bi bi-gear', 'title' => 'Settings', 'link' => '/system/default/index', 'order' => 1],
                ['id' => 2, 'role_id' => 1, 'parent_id' => 1, 'icon' => 'bi bi-circle', 'title' => 'Panel', 'link' => '/system/default/index', 'order' => 1],
                ['id' => 3, 'role_id' => 1, 'parent_id' => 2, 'icon' => 'bi bi-circle', 'title' => 'Menu', 'link' => '/system/menu/index', 'order' => 1],
                ['id' => 4, 'role_id' => null, 'parent_id' => 2, 'icon' => 'bi bi-circle', 'title' => 'Localization', 'link' => '/system/yii-source-message/index', 'order' => 2],
                ['id' => 5, 'role_id' => null, 'parent_id' => 4, 'icon' => 'bi bi-circle', 'title' => 'Yii Source Messages', 'link' => '/system/yii-source-message/index', 'order' => 1],
                ['id' => 6, 'role_id' => null, 'parent_id' => 4, 'icon' => 'bi bi-circle', 'title' => 'Yii Messages', 'link' => '/system/yii-source-message/index', 'order' => 2],
                ['id' => 7, 'role_id' => 1, 'parent_id' => 1, 'icon' => 'bi bi-circle', 'title' => 'Access', 'link' => '/system/action/index', 'order' => 2],
                ['id' => 8, 'role_id' => 1, 'parent_id' => 7, 'icon' => 'bi bi-circle', 'title' => 'Roles', 'link' => '/system/role/index', 'order' => 1],
                ['id' => 9, 'role_id' => 1, 'parent_id' => 7, 'icon' => 'bi bi-circle', 'title' => 'Users', 'link' => '/system/user/index', 'order' => 2],
                ['id' => 10, 'role_id' => 1, 'parent_id' => 7, 'icon' => 'bi bi-circle', 'title' => 'Actions', 'link' => '/system/action/index', 'order' => 3],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('menu');
        return true;
    }
}
