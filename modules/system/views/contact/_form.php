<?php

use uzdevid\dashboard\models\service\ContactService;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\Contact $model */
/** @var yii\widgets\ActiveForm $form */
?>


<?php $form = ActiveForm::begin(['id' => 'contact-create-form']); ?>

<?php echo $form->field($model, 'type', ['options' => ['class' => 'mb-3']])->dropDownList(ContactService::typesList()); ?>

<?php echo $form->field($model, 'contact', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]); ?>

<div class="form-group text-end">
    <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']); ?>
</div>

<?php ActiveForm::end(); ?>

<script>
    new Choices('#contact-type');
</script>
