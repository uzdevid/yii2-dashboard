<?php

/** @var yii\web\View $this */

/** @var uzdevid\dashboard\models\NotificationTypeRole $model */

use uzdevid\dashboard\models\service\MenuService;

$this->title = Yii::t('system.crud', 'Create Notification Type Role');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/notification-type/index');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="row">
        <div class="col-6">
            <?php echo $this->render('_form', compact('model')); ?>
        </div>
    </div>
</section>
