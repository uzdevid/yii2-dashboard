<?php

use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\models\ModifyLog;
use uzdevid\dashboard\models\service\MenuService;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \uzdevid\dashboard\models\search\ModifyLogSearch $searchModel */

$this->title = Yii::t('system.menu', 'Modified models');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="card">
        <div class="card-body py-4">
            <?php Pjax::begin(); ?>

            <div class="table-responsive">
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
                            'attribute' => 'model',
                            'format' => 'html',
                            'headerOptions' => [
                                'style' => 'min-width: 200px;'
                            ],
                        ],
                        [
                            'attribute' => 'model_id',
                            'format' => 'html',
                            'headerOptions' => [
                                'style' => 'min-width: 200px;'
                            ],
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
                                return Url::to([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>

            <?php Pjax::end(); ?>
        </div>
    </div>
</section>
