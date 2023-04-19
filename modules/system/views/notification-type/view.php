<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\NotificationType $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system.crud', 'Notification Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="notification-type-view">

    <p>
        <?php echo Html::a(Yii::t('system.crud', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('system.crud', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('system.crud', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'icon',
            'behavior',
        ],
    ]); ?>

</div>
