<?php

use uzdevid\dashboard\modalpage\ModalPage;
use uzdevid\dashboard\components\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\Action $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system.crud', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="card">
        <div class="card-body py-3">
            <div class="text-end mb-3">
                <?php echo ModalPage::link(Yii::t('system.crud', 'Update'), Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-primary']); ?>
                <?php echo Html::a(Yii::t('system.crud', 'Delete'), Url::to(['delete', 'id' => $model->id]), [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('system.crud', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]); ?>
            </div>

            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'path',
                ],
            ]); ?>
        </div>
    </div>
</section>
