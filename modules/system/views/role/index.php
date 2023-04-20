<?php

use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\models\Role;
use uzdevid\dashboard\models\service\MenuService;
use yii\bootstrap5\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('system.menu', 'Roles');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body py-3">
                    <div class="text-end">
                        <?php echo ModalPage::link(Yii::t('system.content', 'Create Role'), Url::to(['create']), ['class' => 'btn btn-success']); ?>
                    </div>

                    <?php Pjax::begin(); ?>

                    <?php echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            [
                                'attribute' => 'name',
                                'format' => 'raw',
                                'value' => function (Role $model) {
                                    return $model->translatedName;
                                }
                            ],
                            [
                                'class' => ActionColumn::class,
                                'template' => '{update} {delete}',
                                'buttons' => [
                                    'update' => function ($url, Role $model, $key) {
                                        return ModalPage::link('<i class="bi bi-pencil"></i>', $url, [
                                            'class' => 'btn btn-sm btn-primary',
                                            'title' => Yii::t('system.crud', 'Update'),
                                        ]);
                                    },
                                    'delete' => function ($url, Role $model, $key) {
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
                                'contentOptions' => ['class' => 'text-end', 'style' => 'width: 100px'],
                                'urlCreator' => function ($action, Role $model, $key, $index, $column) {
                                    return Url::to([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>