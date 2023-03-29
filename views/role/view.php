<?php

use dashboard\modalpage\ModalPage;
use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\Role;
use uzdevid\dashboard\models\service\MenuService;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var Role $model */

$this->title = $model->translatedName;
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/role');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body py-3">
                    <div class="text-end mb-3">
                        <?php echo ModalPage::link(Yii::t('system.crud', 'Update'), Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-primary']) ?>
                        <?php echo ModalPage::link(Yii::t('system.crud', 'Delete'), Url::to(['delete', 'id' => $model->id]), [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]); ?>
                    </div>

                    <?php echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>