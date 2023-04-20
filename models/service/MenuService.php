<?php

namespace uzdevid\dashboard\models\service;

use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\overrides\Url;
use yii\web\NotFoundHttpException;

class MenuService {
    public static function link($menu): string {
        return Url::toRoute([$menu->link, 'menu' => $menu->id]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public static function breadcrumb($url): array {
        $menu = Menu::find()->where(['link' => $url])->one();

        if (is_null($menu)) {
            return ['label' => $url, 'url' => Url::to([$url])];
        }

        return ['label' => $menu->translatedTitle, 'url' => Url::to([$menu->link, 'menu' => $menu->id])];
    }

    public static function list(Menu $model): array {
        return self::getMenusRecursive($model, 1);
    }

    private static function getMenusRecursive(Menu $model, int $level): array {
        $menus[] = [
            'id' => $model->id,
            'parent_id' => (int)$model->parent_id,
            'icon' => $model->icon,
            'title' => $model->translatedTitle,
            'link' => $model->link,
            'level' => $level,
        ];

        foreach ($model->menus as $menu) {
            $menus = array_merge($menus, self::getMenusRecursive($menu, $level + 1));
        }

        return $menus;
    }

    public static function getMenus(): array {
        $menus = Menu::find()->orderBy(['parent_id' => SORT_ASC, 'order' => SORT_ASC])->all();

        $result = [];
        foreach ($menus as $menu) {
            $result[$menu->id] = str_repeat('-', $menu->level) . ' ' . $menu->translatedTitle;
        }

        return $result;
    }
}