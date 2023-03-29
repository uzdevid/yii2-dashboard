<?php

use dashboard\modalpage\ModalPage;
use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\YiiMessage;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var Menu $model */
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
                        'category',
                        'message:ntext',
                    ],
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="card-title"><?php echo Yii::t('system.content', 'Yii Messages'); ?></h2>

                    <?php echo ModalPage::link(Yii::t('system.content', 'Create Yii Message'), Url::to(['/system/yii-message/create', 'source_message_id' => $model->id]), ['class' => 'btn btn-primary']); ?>
                </div>

                <?php foreach ($model->yiiMessages as $message): ?>
                    <?php echo DetailView::widget([
                        'model' => $message,
                        'attributes' => [
                            [
                                'attribute' => 'id',
                                'value' => function (YiiMessage $model) {
                                    return $model->sourceMessage->message;
                                },
                            ],
                            'language',
                            'translation:ntext',
                        ],
                    ]); ?>
                    <div class="text-end mb-3">
                        <?php echo ModalPage::link(Yii::t('system.crud', 'Update'), Url::to(['update', 'id' => $message->id])); ?>
                        <?php echo Html::a(Yii::t('system.crud', 'Delete'), Url::to(['delete', 'id' => $message->id]), [
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
