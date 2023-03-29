<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\Action $model */

$this->title = Yii::t('system.crud', 'Create Action');
$this->params['breadcrumbs'][] = ['label' => Yii::t('system.crud', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
