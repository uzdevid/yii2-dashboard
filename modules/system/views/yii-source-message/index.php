<?php

use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\search\YiiSourceMessageSearch;
use uzdevid\dashboard\models\service\MenuService;
use uzdevid\dashboard\models\YiiSourceMessage;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use yii\bootstrap5\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var YiiSourceMessageSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('system.menu', 'Yii Source Messages');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="text-end py-3">
                <?php echo ModalPage::link(Yii::t('system.content', 'Create Yii Source Message'), Url::to(['create']), ['class' => 'btn btn-success']) ?>
            </div>

            <?php Pjax::begin(); ?>

            <?= GridView::widget([
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
                    'category',
                    'message:ntext',
                    [
                        'class' => ActionColumn::class,
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, YiiSourceMessage $model, $key) {
                                return ModalPage::link('<i class="bi bi-eye"></i>', $url, [
                                    'class' => 'btn btn-sm btn-success',
                                    'title' => Yii::t('system.crud', 'View'),
                                ]);
                            },
                            'update' => function ($url, YiiSourceMessage $model, $key) {
                                return ModalPage::link('<i class="bi bi-pencil"></i>', $url, [
                                    'class' => 'btn btn-sm btn-primary',
                                    'title' => Yii::t('system.crud', 'Update'),
                                ]);
                            },
                            'delete' => function ($url, YiiSourceMessage $model, $key) {
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
                        'urlCreator' => function ($action, YiiSourceMessage $model, $key, $index, $column) {
                            return Url::to([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</section>

<div class="yii-source-message-index">


</div>
