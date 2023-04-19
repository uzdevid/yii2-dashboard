<?php

namespace uzdevid\dashboard\widgets\SideBar;

class View extends \yii\web\View {
    public function createLink($link, $activeClass = ''): string {
        $isActive = $this->isActiveLink($link);
        return $this->render('link', compact('link', 'isActive', 'activeClass'));
    }

    public function createList($list, $level = 1): string {
        $isActive = $this->isActiveList($list);
        return $this->render('list', compact('list', 'isActive', 'level'));
    }

    private function isActiveLink($link): bool {
        return $link->id == @$this->params['menu']->id;
    }

    private function isActiveList($list): bool {
        if (is_null($this->params['menu'])) {
            return false;
        }

        $menu = $this->params['menu'];

        $parentIds = [];
        $parent = $menu;

        while ($parent) {
            $parentIds[] = $parent->id;
            $parent = $parent->parent;
        }

        if (in_array($list->id, $parentIds)) {
            return true;
        }

        return false;
    }

}