<?php

use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\service\MenuService;

/** @var yii\web\View $this */
/** @var Menu $model */

$this->title = Yii::t('system.content', 'Create Menu');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/menu');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-body pt-3">
                    <?php echo $this->render('_form', compact('model')); ?>
                </div>
            </div>
        </div>
    </div>
</section>
