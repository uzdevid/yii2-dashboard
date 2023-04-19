<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\YiiMessage $model */

$this->title = Yii::t('system.content', 'Create Yii Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('system.content', 'Yii Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yii-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
