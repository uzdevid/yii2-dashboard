<?php

use uzdevid\dashboard\models\service\MenuService;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\YiiSourceMessage $model */

$this->title = Yii::t('system.content', 'Yii Source Message');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/yii-source-message/index');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yii-source-message-view">

    <p>
        <?= Html::a(Yii::t('system.crud', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('system.crud', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category',
            'message:ntext',
        ],
    ]); ?>

</div>
