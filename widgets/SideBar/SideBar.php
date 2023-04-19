<?php

namespace uzdevid\dashboard\widgets\SideBar;

use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\widgets\SideBar\View;
use yii\base\Widget;
use Yii;

class SideBar extends Widget {
    /**
     * @return void
     */
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
            ->andWhere(['role_id' => Yii::$app->user->identity->role->id])
            ->orWhere(['parent_id' => null, 'role_id' => null])
            ->orderBy(['order' => SORT_ASC])
            ->all();

        return $this->render('index', compact(['menu']));
    }
}