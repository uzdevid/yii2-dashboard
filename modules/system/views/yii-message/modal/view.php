<?php

use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\YiiMessage;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var Menu $model */
?>


<div class="card">
    <div class="card-body">
        <div class="text-end py-2">
            <?php echo Html::a(Yii::t('system.crud', 'Update'), Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-primary']); ?>
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
    </div>
</div>
