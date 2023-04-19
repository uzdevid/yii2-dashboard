<?php

use uzdevid\dashboard\assets\DashboardAsset;
use uzdevid\dashboard\widgets\Footer\Footer;
use uzdevid\dashboard\widgets\Header\Header;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\widgets\ModalPage\ModalPageAsset;
use uzdevid\dashboard\widgets\OffCanvasPage\OffCanvasPage;
use uzdevid\dashboard\widgets\OffCanvasPage\OffCanvasPageAsset;
use uzdevid\dashboard\widgets\SideBar\SideBar;
use uzdevid\dashboard\widgets\Toaster\ToasterAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\web\View;

/** @var string $content */
/** @var View $this */

DashboardAsset::register($this);
ToasterAsset::register($this);
ModalPageAsset::register($this);
OffCanvasPageAsset::register($this);
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?php echo Yii::$app->language; ?>">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title><?php echo $this->title; ?> :: <?php echo Yii::$app->name; ?></title>
        <meta name="robot" content="none">

        <link href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon.png" rel="icon">
        <link href="<?php echo Yii::$app->request->baseUrl; ?>/img/apple-touch-icon.png" rel="apple-touch-icon">

        <script>
            const BASEURL = '<?php echo Yii::$app->params['url']; ?>';
            const LANGUAGE = '<?php echo Yii::$app->language; ?>';
        </script>

        <?php $this->head(); ?>
    </head>

    <body>
    <?php $this->beginBody(); ?>
    <?php echo Header::widget(); ?>
    <?php echo SideBar::widget(); ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1><?php echo $this->title; ?></h1>
            <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'options' => []]); ?>
        </div>

        <?php echo $content; ?>
    </main>

    <?php echo Footer::widget(); ?>

    <?php echo OffCanvasPage::widget(); ?>

    <?php echo ModalPage::widget(); ?>

    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>