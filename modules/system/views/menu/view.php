<?php

use uzdevid\dashboard\overrides\Url;
use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\service\MenuService;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var Menu $model */

$this->title = Yii::t('system.content', 'View');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/menu');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title"><?php echo Yii::t('system.content', 'Menu data'); ?></h2>
                        <div>
                            <?php echo Html::a(Yii::t('system.crud', 'Update'), Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-primary']); ?>
                            <?php echo Html::a(Yii::t('system.crud', 'Delete'), Url::to(['delete', 'id' => $model->id]), [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]); ?>
                        </div>
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
        </div>
    </div>
</section>
