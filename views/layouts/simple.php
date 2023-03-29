<?php

use app\assets\SimpleAsset;
use yii\web\View;

/**
 * @var View $this
 * @var string $content
 */

\uzdevid\dashboard\assets\SimpleDashboardAsset::register($this);
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?php echo Yii::$app->language; ?>">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title><?php echo $this->title; ?></title>
        <meta name="robot" content="none">

        <!-- Favicons -->
        <link href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon.png" rel="icon">
        <link href="<?php echo Yii::$app->request->baseUrl; ?>/img/apple-touch-icon.png" rel="apple-touch-icon">

        <?php $this->head(); ?>
    </head>

    <body>
    <?php $this->beginBody(); ?>

    <main>
        <?php echo $content; ?>
    </main>

    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>