<?php

use uzdevid\dashboard\models\YiiMessage;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\YiiMessage $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system.content', 'Yii Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yii-message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('system.crud', 'Update'), ['update', 'id' => $model->id, 'language' => $model->language], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('system.crud', 'Delete'), ['delete', 'id' => $model->id, 'language' => $model->language], [
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
            [
                'attribute' => 'id',
                'value' => function (YiiMessage $model) {
                    return $model->sourceMessage->message;
                },
            ],
            'language',
            'translation:ntext',
        ],
    ]); ?>

</div>
