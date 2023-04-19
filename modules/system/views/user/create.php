<?php

use uzdevid\dashboard\models\User;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var User $model */

$this->title = Yii::t('system.content', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('system.content', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', compact('model')); ?>

</div>
