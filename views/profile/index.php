<?php

use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

/**
 * @var View $this
 * @var User $user
 */
?>

<section class="section profile">
    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="<?php echo $user->profileImage; ?>" alt="Profile image" class="rounded-circle">
                    <h2><?php echo $user->fullname; ?></h2>
                    <h3><?php echo $user->role->translatedName; ?></h3>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title"><?php echo Yii::t('system.content', 'Your contacts'); ?></h5>
                        </div>
                        <div class="col text-end">
                            <?php echo ModalPage::link(Yii::t('system.content', 'Create Contact'), Url::to(['/system/contact/create']), ['class' => 'btn btn-primary py-1 px-3']); ?>
                        </div>
                    </div>

                    <ul class="ps-0">
                        <?php foreach ($user->contacts as $i => $contact): ?>
                            <li class="row align-items-center p-2">
                                <div class="col-1">
                                    <i class="bi bi-journal fs-4 text-primary"></i>
                                </div>
                                <div class="col-11 d-flex justify-content-between">
                                    <div>
                                        <p class="mb-0"><?php echo $contact->contact; ?></p>
                                        <p class="mb-0 small text-muted"><?php echo $contact->translatedType; ?></p>
                                    </div>

                                    <div>
                                        <?php echo Html::a('<i class="bi bi-trash fs-6"></i>', Url::to(['/system/contact/delete', 'id' => $contact->id]), [
                                            'class' => 'border-0 px-3 py-2 rounded btn btn-danger',
                                            'data' => [
                                                'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                                                'method' => 'post',
                                            ],
                                        ]); ?>
                                    </div>
                                </div>
                            </li>
                            <?php if (count($user->contacts) - 1 > $i): ?>
                                <hr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-7">
            <div class="card">
                <div class="card-body pt-3">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"><?php echo Yii::t('system.content', 'Overview'); ?></button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"><?php echo Yii::t('system.content', 'Edit profile'); ?></button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"><?php echo Yii::t('system.content', 'Change password'); ?></button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-active-sessions"><?php echo Yii::t('system.content', 'Active sessions'); ?></button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><?php echo Yii::t('system.content', 'Full name'); ?></div>
                                <div class="col-lg-9 col-md-8"><?php echo $user->fullname; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label"><?php echo Yii::t('system.content', 'Role'); ?></div>
                                <div class="col-lg-9 col-md-8"><?php echo $user->role->translatedName; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label"><?php echo Yii::t('system.content', 'Email'); ?></div>
                                <div class="col-lg-9 col-md-8"><?php echo $user->email; ?></div>
                            </div>
                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                            <?php $form = ActiveForm::begin([
                                'id' => 'profile-form',
                                'fieldConfig' => [
                                    'template' => '<div class="form-floating mb-3">{input}{label}{error}</div>',
                                    'labelOptions' => ['class' => 'form-label'],
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'invalid-feedback'],
                                ],
                            ]); ?>

                            <?php echo $form->field($user, 'surname')->textInput(['placeholder' => $user->getAttributeLabel('surname')]); ?>
                            <?php echo $form->field($user, 'name')->textInput(['placeholder' => $user->getAttributeLabel('name')]); ?>
                            <?php echo $form->field($user, 'email')->textInput(['type' => 'email', 'placeholder' => $user->getAttributeLabel('email')]); ?>
                            <?php echo $form->field($user, 'image', ['template' => '{label}{input}{error}'])->fileInput(); ?>

                            <div class="text-end">
                                <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']); ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <?php $form = ActiveForm::begin([
                                'id' => 'reset-password-form',
                                'fieldConfig' => [
                                    'template' => '<div class="form-floating mb-3">{input}{label}{error}</div>',
                                    'labelOptions' => ['class' => ''],
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'invalid-feedback'],
                                ],
                            ]); ?>
                            <?php $user->scenario = 'resetPassword'; ?>
                            <?php echo $form->field($user, 'new_password')->textInput(['type' => 'password', 'placeholder' => $user->getAttributeLabel('new_password')]); ?>

                            <div class="text-end">
                                <?php echo Html::submitButton(Yii::t('system.crud', 'Save'), ['class' => 'btn btn-success']); ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-active-sessions">
                            <ul class="ps-0">
                                <?php foreach ($user->devices as $i => $device): ?>
                                    <li class="row align-items-center p-2">
                                        <div class="col-1">
                                            <i class="bi bi-check-circle fs-4 text-success"></i>
                                        </div>
                                        <div class="col-11 d-flex justify-content-between">
                                            <div>
                                                <p class="mb-0"><?php echo $device->deviceName; ?></p>
                                                <p class="mb-0 small text-muted"><?php echo $device->formattedAuthTime; ?></p>
                                            </div>
                                            <div>
                                                <?php echo Html::a('<i class="bi bi-trash fs-6"></i>', Url::to(['/system/device/delete', 'id' => $device->id]), [
                                                    'class' => 'border-0 px-3 py-2 rounded btn btn-danger',
                                                    'data' => [
                                                        'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                                                        'method' => 'post',
                                                    ],
                                                ]); ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php if (count($user->devices) - 1 > $i): ?>
                                        <hr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>