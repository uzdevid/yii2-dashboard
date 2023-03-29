<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\Action $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="action-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'path', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]) ?>

    <div class="form-group text-end">
        <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
