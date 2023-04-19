<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\search\NotificationTypeSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notification-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'icon') ?>

    <?= $form->field($model, 'behavior') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('system.crud', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('system.crud', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
