<?php

use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\models\Menu;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var Menu $model */
?>

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
                [
                    'attribute' => 'role_id',
                    'value' => $model->role?->translatedName,
                ],
                [
                    'attribute' => 'parent_id',
                    'value' => $model->parent?->translatedTitle,
                ],
                [
                    'attribute' => 'icon',
                    'format' => 'html',
                    'value' => Html::tag('i', '', ['class' => $model->icon]),
                ],
                [
                    'attribute' => 'title',
                    'value' => $model->translatedTitle,
                ],
                'link',
                'order',
            ],
        ]); ?>
    </div>
</div>
