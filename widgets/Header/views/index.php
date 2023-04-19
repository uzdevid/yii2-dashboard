<?php

use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\Notification;
use uzdevid\dashboard\models\User;

/**
 * @var User $user
 * @var User[] $online_users
 * @var User[] $users
 * @var Notification[] $unread_notifications
 */
?>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-app-between">
            <a href="<?php echo Url::toRoute(Yii::$app->homeUrl); ?>" class="logo d-flex align-items-center">
                <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png" alt="<?php echo Yii::$app->name; ?>">
                <span class="d-none d-lg-block"><?php echo Yii::$app->name; ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <?php if (class_exists(\uzdevid\dashboard\onlines\widgets\Onlines\Onlines::class)): ?>
                    <?php echo \uzdevid\dashboard\onlines\widgets\Onlines\Onlines::widget(); ?>
                <?php endif; ?>

                <?php if (class_exists(\uzdevid\dashboard\chat\widgets\NavButton\NavButton::class)): ?>
                    <?php echo \uzdevid\dashboard\chat\widgets\NavButton\NavButton::widget(); ?>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon btn btn-outline-light" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span id="notifications-badge" class="badge bg-primary badge-number" style="<?php echo count($unread_notifications) == 0 ? 'display:none;' : ''; ?>"><?php echo count($unread_notifications); ?></span>
                    </a>
                    <ul id="notifications-mini-list" class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications"></ul>
                </li>

                <li class="nav-item dropdown pe-3">
                    <button class="nav-link nav-profile d-flex align-items-center pe-0 btn btn-outline-light" data-bs-toggle="dropdown">
                        <img src="<?php echo $user->profileImage; ?>" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user->fullname; ?></span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $user->fullname; ?></h6>
                            <span><?php echo $user->role->translatedName; ?></span>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo Url::toRoute(['/system/profile']); ?>">
                                <i class="bi bi-person"></i>
                                <span><?php echo Yii::t('system.content', 'My profile'); ?></span>
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo Url::toRoute(['/system/login/out']); ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span><?php echo Yii::t('system.content', 'Sign Out'); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

<?php if (class_exists(\uzdevid\dashboard\chat\widgets\ChatOffcanvas\ChatOffcanvas::class)): ?>
    <?php echo \uzdevid\dashboard\chat\widgets\ChatOffcanvas\ChatOffcanvas::widget(); ?>
<?php endif; ?>