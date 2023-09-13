<?php

namespace uzdevid\dashboard\models;

use Yii;

/**
 * @property string $translatedTitle
 */
class Menu extends base\Menu {
    public function getTranslatedTitle(): string {
        return Yii::t('system.menu', $this->title);
    }

    public function getMenus() {
        return $this->hasMany(Menu::class, ['parent_id' => 'id']);
    }

    public function getParent() {
        return $this->hasOne(Menu::class, ['id' => 'parent_id']);
    }

    public function getLevel(): int {
        $level = 0;
        $parent = $this->parent;

        while ($parent) {
            $level++;
            $parent = $parent->parent;
        }

        return $level;
    }
}
