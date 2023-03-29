<?php

use uzdevid\dashboard\models\service\MenuService;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\YiiSourceMessage $model */

$this->title = Yii::t('system.content', 'Create Yii Source Message');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/yii-source-message');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yii-source-message-create">
    <?php echo $this->render('_form', compact('model')); ?>
</div>
