<?php

use dashboard\modalpage\ModalPage;
use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\service\UserService;
use uzdevid\dashboard\models\User;
use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var User $model */
?>

<div class="card">
    <div class="card-body py-3">
        <div class="row">
            <div class="col-6">
                <?php echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                            'attribute' => 'user_id',
                            'format' => 'html',
                            'value' => function (User $model) {
                                return $model->user == null ? null : ModalPage::link($model->user->fullname, Url::to(['/system/user/view', 'id' => $model->user_id]));
                            }
                        ],
                        'email:email',
                        'surname',
                        'name',
                        [
                            'attribute' => 'role_id',
                            'value' => function (User $model) {
                                return $model->role->translatedName;
                            }
                        ],
                        'language',
                        'last_activity_time',
                        'last_update_time',
                        'create_time',
                    ],
                ]); ?>
                <?php if (UserService::canIDeleteUser($model)): ?>
                    <div class="text-end">
                        <?php echo Html::a(Yii::t('system.crud', 'Delete'), Url::to(['delete', 'id' => $model->id]), [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-6">
                <?php foreach ($model->contacts as $contact): ?>
                    <?php echo DetailView::widget([
                        'model' => $contact,
                        'attributes' => [
                            'type',
                            'contact',
                        ],
                    ]); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
