<?php

use uzdevid\dashboard\models\form\LoginForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var LoginForm $model */
?>

<div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex justify-content-center py-4">
                        <div class="logo d-flex align-items-center w-auto">
                            <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png" alt="<?php echo Yii::$app->name; ?>">
                            <span class="d-none d-lg-block"><?php echo Yii::$app->name; ?></span>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4"><?php echo $this->title; ?></h5>
                                <p class="text-center small"><?php echo Yii::t('system.form', 'Enter your email and password to login'); ?></p>
                            </div>

                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'layout' => 'horizontal',
                                'options' => ['class' => 'row g-3 needs-validation', 'novalidate' => 'novalidate'],
                                'fieldConfig' => [
                                    'horizontalCssClasses' => [
                                        'offset' => false,
                                    ],
                                    'options' => [
                                        'class' => '',
                                    ],
                                    'labelOptions' => ['class' => 'form-label'],
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'invalid-feedback'],
                                ],
                            ]); ?>

                            <?php echo $form->field($model, 'email', ['template' => $this->params['layouts']['fields']['email']])->textInput(['type' => 'email']); ?>

                            <?php echo $form->field($model, 'password', ['template' => $this->params['layouts']['fields']['password']])->textInput(['type' => 'password']); ?>

                            <?php echo $form->field($model, 'rememberMe', ['template' => $this->params['layouts']['fields']['rememberMe']])->checkbox(); ?>

                            <div class="col-12">
                                <?php echo Html::submitButton(Yii::t('system.form', 'Login'), ['class' => 'btn btn-primary w-100']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <div class="credits">
                        <?php echo Yii::t('system.content', 'Powered by <a href="https://devid.uz" target="_blank">UzDevid</a>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>