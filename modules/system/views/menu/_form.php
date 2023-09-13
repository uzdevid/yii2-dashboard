<?php

use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\service\MenuService;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Menu $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-6">
        <?php echo $form->field($model, 'parent_id', ['options' => ['class' => 'mb-3']])->dropDownList(MenuService::getMenus(), ['prompt' => Yii::t('system.content', 'Choose parent menu')]); ?>

        <?php echo $form->field($model, 'icon', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]); ?>

        <?php echo $form->field($model, 'title', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]); ?>
    </div>
    <div class="col-6">
        <?php echo $form->field($model, 'link', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]); ?>

        <?php echo $form->field($model, 'order', ['options' => ['class' => 'mb-3']])->textInput(); ?>
    </div>
</div>

<div class="form-group text-end">
    <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<script>
    new Choices(document.getElementById('menu-parent_id'));
</script>