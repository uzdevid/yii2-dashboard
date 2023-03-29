<?php

use uzdevid\dashboard\modalpage\ModalPage;
use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\ModifyLog;
use uzdevid\dashboard\models\service\MenuService;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('system.menu', 'Modified models');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="card">
        <div class="card-body py-4">
            <?php Pjax::begin(); ?>

            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'class' => 'yii\bootstrap5\LinkPager',
                    'maxButtonCount' => 15,
                    'options' => [
                        'tag' => 'nav',
                        'class' => 'd-flex justify-content-center',
                    ]
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'user_id',
                        'format' => 'html',
                        'value' => function (ModifyLog $model) {
                            return ModalPage::link($model->user->fullName, Url::to(['/system/user/view', 'id' => $model->user_id]));
                        }
                    ],
                    'model',
                    'model_id',
                    'attribute',
                    'value:ntext',
                    'old_value:ntext',
                    'modify_time',
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</section>
