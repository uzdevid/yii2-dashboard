<?php

use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\overrides\Url;
use uzdevid\dashboard\models\service\MenuService;
use uzdevid\dashboard\models\User;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var User $model */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/user/index');
$this->params['breadcrumbs'][] = $model->fullName;
?>

<section class="section">
    <div class="card">
        <div class="card-body py-3">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'user_id',
                        'format' => 'html',
                        'value' => function (User $model) {
                            return $model->user == null ? null : ModalPage::link($model->user->fullName, Url::to(['/user/view', 'id' => $model->user_id]));
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
        </div>
    </div>
</section>
