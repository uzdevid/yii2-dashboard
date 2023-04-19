<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\NotificationType $model */

$this->title = Yii::t('system.crud', 'Update Notification Type: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('system.crud', 'Notification Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('system.crud', 'Update');
?>
<div class="notification-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
