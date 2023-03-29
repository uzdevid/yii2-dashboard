<?php

/** @var yii\web\View $this */
/** @var Menu $model */

use uzdevid\dashboard\models\Menu;

?>

<div class="card">
    <div class="card-body py-2">
        <?php echo $this->render('../_form', ['model' => $model]); ?>
    </div>
</div>