<?php

use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\Action;
use yii\bootstrap5\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\search\ActionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('system.crud', 'Actions');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">

    <div class="card">
        <div class="card-body py-3">
            <div class="text-end">
                <?php echo ModalPage::link(Yii::t('system.crud', 'Create'), Url::to(['create']), ['class' => 'btn btn-success']); ?>
            </div>

            <?php Pjax::begin(); ?>

            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pager' => [
                    'class' => 'yii\bootstrap5\LinkPager',
                    'maxButtonCount' => 15,
                    'options' => [
                        'tag' => 'nav',
                        'class' => 'd-flex justify-content-center',
                    ]
                ],
                'columns' => [
                    'id',
                    'path',
                    [
                        'class' => ActionColumn::class,
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, Action $model, $key) {
                                return ModalPage::link('<i class="bi bi-eye"></i>', $url, [
                                    'class' => 'btn btn-sm btn-success',
                                    'title' => Yii::t('system.crud', 'View'),
                                ]);
                            },
                            'update' => function ($url, Action $model, $key) {
                                return ModalPage::link('<i class="bi bi-pencil"></i>', $url, [
                                    'class' => 'btn btn-sm btn-primary',
                                    'title' => Yii::t('system.crud', 'Update'),
                                ]);
                            },
                            'delete' => function ($url, Action $model, $key) {
                                return Html::a('<i class="bi bi-trash"></i>', $url, [
                                    'class' => 'btn btn-sm btn-danger',
                                    'title' => Yii::t('system.crud', 'Delete'),
                                    'data' => [
                                        'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ]);
                            },
                        ],
                        'contentOptions' => ['class' => 'text-end', 'style' => 'width: 130px'],
                        'urlCreator' => function ($action, Action $model, $key, $index, $column) {
                            return Url::to([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>

</section>
