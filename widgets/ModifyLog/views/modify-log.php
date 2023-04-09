<?php

use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\modalpage\ModalPage;
use uzdevid\dashboard\models\ModifyLog;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>

<div class="table-responsive">
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'headerOptions' => [
                    'style' => 'min-width: 200px;'
                ],
                'value' => function (ModifyLog $model) {
                    return ModalPage::link($model->user->fullName, Url::to(['/system/user/view', 'id' => $model->user_id]));
                }
            ],
            [
                'attribute' => 'attribute',
                'format' => 'html',
                'headerOptions' => [
                    'style' => 'min-width: 200px;'
                ],
                'value' => function (ModifyLog $model) {
                    return Yii::t('system.model', $model->attribute);
                }
            ],
            [
                'attribute' => 'modify_time',
                'format' => 'datetime',
                'headerOptions' => [
                    'style' => 'min-width: 200px;'
                ],
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{diff}',
                'buttons' => [
                    'diff' => static function ($url, ModifyLog $model, $key) {
                        return ModalPage::link('<i class="bi bi-plus-slash-minus"></i>', $url, [
                            'class' => 'btn btn-sm btn-success',
                            'title' => Yii::t('system.crud', 'View'),
                        ]);
                    },
                ],
                'headerOptions' => ['class' => 'text-end', 'style' => 'max-width: 30px'],
                'urlCreator' => static function ($action, ModifyLog $model, $key, $index, $column) {
                    return Url::to(["/system/modify-log/${action}", 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>

<div class="text-center">
    <a class="btn btn-primary" href="<?php echo Url::to(['/system/modify-log', 'ModifyLogSearch' => ['model' => $model, 'model_id' => $id]]); ?>"><?php echo Yii::t('system.content', 'All changes'); ?></a>
</div>