<?php

use uzdevid\dashboard\models\service\MenuService;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\YiiMessage $model */

$this->title = Yii::t('system.content', 'Update Yii Source Message');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="card">
        <div class="card-body py-3">
            <?php echo $this->render('_form', compact('model')); ?>
        </div>
    </div>
</section>
