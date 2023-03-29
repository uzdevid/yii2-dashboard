<?php

use uzdevid\dashboard\models\service\LanguageService;
use uzdevid\dashboard\models\service\RoleService;
use uzdevid\dashboard\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var User $model */
/** @var yii\widgets\ActiveForm $form */
?>


<?php $form = ActiveForm::begin(); ?>
<?php
echo $form->errorSummary($model);
?>

    <div class="alert alert-info">
        <?php echo Yii::t('system.message', 'The user will receive an email with login details for the control panel'); ?>
    </div>
    <div class="row py-3">
        <div class="col-6">
            <?php echo $form->field($model, 'surname', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]); ?>

            <?php echo $form->field($model, 'name', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]); ?>

            <?php echo $form->field($model, 'email', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true, 'type' => 'email']); ?>
        </div>
        <div class="col-6">
            <?php echo $form->field($model, 'role_id', ['options' => ['class' => 'mb-3']])->dropDownList(RoleService::list()); ?>

            <?php echo $form->field($model, 'language', ['options' => ['class' => 'mb-3']])->dropDownList(LanguageService::list()); ?>
        </div>
    </div>

    <div class="form-group text-end">
        <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

<script>
    new Choices(document.getElementById('user-language'));
    new Choices(document.getElementById('user-role_id'));
</script>
