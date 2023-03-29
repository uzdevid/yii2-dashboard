<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\YiiSourceMessage $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'category', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]); ?>

<?php echo $form->field($model, 'message', ['options' => ['class' => 'mb-3']])->textarea(['rows' => 2]); ?>

<div class="form-group text-end">
    <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']); ?>
</div>

<?php ActiveForm::end(); ?>
