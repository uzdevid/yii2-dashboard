<?php

use uzdevid\dashboard\models\service\LanguageService;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\YiiMessage $model */
/** @var yii\widgets\ActiveForm $form */
?>


<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'id', ['options' => ['class' => 'mb-3']])->textInput(); ?>

<?php echo $form->field($model, 'language', ['options' => ['class' => 'mb-3']])->dropDownList(LanguageService::list()); ?>

<?php echo $form->field($model, 'translation', ['options' => ['class' => 'mb-3']])->textarea(['rows' => 2]); ?>

<div class="form-group">
    <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']); ?>
</div>

<?php ActiveForm::end(); ?>

<script>
    new Choices(document.getElementById('yiimessage-language'));
</script>