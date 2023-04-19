<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\search\MenuSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'role_id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'icon') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'order') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('system.crud', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('system.crud', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
