<?php

use uzdevid\dashboard\models\Role;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var Role $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'name', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]) ?>

    <div class="form-group text-end">
        <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
