<?php

namespace uzdevid\dashboard\widgets\SideBar;

use uzdevid\dashboard\models\Menu;
use yii\base\Widget;

class SideBar extends Widget {
    public function init() {
        $this->view = new View();
        parent::init();
    }

    /**
     * @return string
     */
    public function run() {
        parent::run();

        $this->view->params['menu'] = Menu::findOne(@$_GET['menu']);
        $menu = Menu::find()
            ->where(['parent_id' => null])
            ->orderBy(['order' => SORT_ASC])
            ->all();

        return $this->render('index', compact(['menu']));
    }
}