<?php

use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\models\User;

/**
 * @var User $user
 */
?>

<li class="nav-item dropdown pe-3">
    <button class="nav-link nav-profile d-flex align-items-center pe-0 btn btn-outline-light" data-bs-toggle="dropdown">
        <img src="<?php echo $user->profileImage; ?>" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user->fullname; ?></span>
    </button>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
            <h6><?php echo $user->fullname; ?></h6>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="<?php echo Url::to(['/system/profile']); ?>">
                <i class="bi bi-person"></i>
                <span><?php echo Yii::t('system.content', 'My profile'); ?></span>
            </a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="<?php echo Url::to(['/system/login/out']); ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span><?php echo Yii::t('system.content', 'Sign Out'); ?></span>
            </a>
        </li>
    </ul>
</li>