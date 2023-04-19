<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\NotificationType $model */

$this->title = Yii::t('system.crud', 'Create Notification Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('system.crud', 'Notification Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
