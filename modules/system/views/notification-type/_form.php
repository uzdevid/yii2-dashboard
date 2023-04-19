<?php

use uzdevid\dashboard\models\service\NotificationService;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\NotificationType $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notification-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'name', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'icon', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'behavior', ['options' => ['class' => 'mb-3']])->dropDownList(NotificationService::behaviorsList()) ?>

    <div class="form-group text-end">
        <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    new Choices(document.getElementById('notificationtype-behavior'));
</script>