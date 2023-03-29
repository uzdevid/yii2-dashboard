<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\NotificationTypeRole $model */
/** @var yii\widgets\ActiveForm $form */
?>


<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'notification_type_id', ['options' => ['class' => 'mb-3']])->textInput(); ?>

<?php echo $form->field($model, 'role_id', ['options' => ['class' => 'mb-3']])->textInput(); ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

<?php ActiveForm::end(); ?>