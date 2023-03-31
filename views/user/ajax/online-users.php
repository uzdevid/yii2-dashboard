<?php

use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\modalpage\ModalPage;
use uzdevid\dashboard\models\User;

/**
 * @var User[] $online_users
 * @var User[] $users
 */
?>

<?php foreach ($online_users as $_user): ?>
    <li class="online-user-item position-relative">
        <img width="50px" height="50px" src="<?php echo $_user->profileImage; ?>" class="rounded-circle">
        <div class="ps-2">
            <h4><?php echo $_user->fullname; ?></h4>
            <p>
                <i class="bi bi-circle-fill text-success m-0" style="font-size: 12px;"></i>
                <span><?php echo date('H:i', $_user->last_activity_time); ?></span>
            </p>
        </div>
        <?php echo ModalPage::link('', Url::to(['/system/user/view', 'id' => $_user->id]), ['class' => 'stretched-link']); ?>
    </li>
<?php endforeach; ?>
<?php if (!empty($users) && !empty($online_users)): ?>
    <hr>
<?php endif; ?>
<?php foreach ($users as $_user): ?>
    <li class="online-user-item position-relative">
        <img width="50px" height="50px" src="<?php echo $_user->profileImage; ?>" class="rounded-circle">
        <div class="ps-2">
            <h4><?php echo $_user->fullname; ?></h4>
            <p>
                <i class="bi bi-circle-fill text-secondary m-0" style="font-size: 12px;"></i>
                <span><?php echo date('H:i', $_user->last_activity_time); ?></span>
            </p>
        </div>
        <?php echo ModalPage::link('', Url::to(['/system/user/view', 'id' => $_user->id]), ['class' => 'stretched-link']); ?>
    </li>
<?php endforeach; ?>