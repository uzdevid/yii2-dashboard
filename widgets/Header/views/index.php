<?php

use uzdevid\dashboard\base\helpers\Url;
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
                    <?php \uzdevid\dashboard\onlines\widgets\Onlines\OnlinesAsset::register($this); ?>
                    <?php echo \uzdevid\dashboard\onlines\widgets\Onlines\Onlines::widget(); ?>
                <?php endif; ?>

                <?php if (class_exists(\uzdevid\dashboard\chat\widgets\NavButton\NavButton::class)): ?>
                    <?php echo \uzdevid\dashboard\chat\widgets\NavButton\NavButton::widget(); ?>
                <?php endif; ?>

                <?php if (class_exists(\uzdevid\dashboard\notification\widgets\Notification\Notification::class)): ?>
                    <?php echo \uzdevid\dashboard\notification\NotificationAsset::register($this); ?>
                    <?php echo \uzdevid\dashboard\notification\widgets\Notification\Notification::widget(); ?>
                <?php endif; ?>

                <?php echo \uzdevid\dashboard\widgets\Profile\Profile::widget(); ?>
            </ul>
        </nav>
    </header>

<?php if (class_exists(\uzdevid\dashboard\chat\widgets\ChatOffcanvas\ChatOffcanvas::class)): ?>
    <?php echo \uzdevid\dashboard\chat\widgets\ChatOffcanvas\ChatOffcanvas::widget(); ?>
<?php endif; ?>