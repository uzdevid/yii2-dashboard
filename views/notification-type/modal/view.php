<?php

use uzdevid\dashboard\modalpage\ModalPage;
use uzdevid\dashboard\components\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\NotificationType $model */
?>

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="text-end py-2">
                    <?php echo Html::a(Yii::t('system.crud', 'Delete'), Url::to(['delete', 'id' => $model->id]), [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]); ?>
                </div>

                <?php echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        'icon',
                        'behavior',
                    ],
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title"><?php echo Yii::t('system.content', 'Notification Type Roles'); ?></h4>

                    <?php echo ModalPage::link(Yii::t('system.content', 'Create Notification Role'), Url::to(['/system/notification-type-role/create', 'id' => $model->id]), ['class' => 'btn btn-primary']); ?>
                </div>

                <?php foreach ($model->notificationTypeRoles as $notificationTypeRole): ?>
                    <?php echo DetailView::widget([
                        'model' => $notificationTypeRole,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'role_id',
                                'value' => $notificationTypeRole->role->translatedName,
                            ],
                        ],
                    ]); ?>
                    <div class="text-end">
                        <?php echo Html::a(Yii::t('system.crud', 'Delete'), Url::to(['/system/notification-type-role/delete', 'id' => $notificationTypeRole->id]), [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]); ?>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
