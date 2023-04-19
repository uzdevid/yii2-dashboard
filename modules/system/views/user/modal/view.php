<?php

use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\service\ContactService;
use uzdevid\dashboard\models\service\UserService;
use uzdevid\dashboard\models\User;
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var User $model */
?>


<div>
    <div class="mb-2 d-flex justify-content-start align-items-start">
        <img width="150px" height="150px" class="rounded-circle" src="<?php echo $model->profileImage; ?>" alt="<?php echo $model->fullname; ?>">
        <div class="ms-3">
            <div>
                <h4><?php echo $model->fullname; ?></h4>
                <p class="text-muted"><?php echo UserService::lastActivityTime($model->last_activity_time); ?> | <?php echo $model->role->translatedName; ?></p>
            </div>
            <div class="mt-5">
                <?php if (class_exists(\uzdevid\dashboard\chat\widgets\Chat\Chat::class) && $model->id != Yii::$app->user->id): ?>
                    <?php echo \uzdevid\dashboard\offcanvaspage\OffCanvas::link(Yii::t('system.content', 'Send message'), Url::to(['/system/chat/room-if-exist', 'companion_id' => $model->id]), ['id' => 'go-to-chat-btn', 'class' => 'btn btn-primary mt-2']); ?>
                <?php endif; ?>
                <?php if (UserService::canIDeleteUser($model)): ?>
                    <?php echo Html::a(Yii::t('system.crud', 'Delete'), Url::to(['delete', 'id' => $model->id]), [
                        'class' => 'btn btn-danger mt-2',
                        'data' => [
                            'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <hr>

    <div>
        <?php foreach ($model->contacts as $contact): ?>
            <a class="small btn bg-primary-light me-1 mt-2" href="<?php echo ContactService::createLink($contact->type, $contact->contact); ?>"><?php echo $contact->contact; ?></a>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $('#modal-page').on('click', '#go-to-chat-btn', function () {
        $('#modal-page').modal('hide');
    });
</script>