<?php

use uzdevid\dashboard\models\Role;
use uzdevid\dashboard\models\service\MenuService;

/** @var yii\web\View $this */
/** @var Role $model */

$this->title = Yii::t('system.content', 'Update role');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/role');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body py-3">
                    <?php echo $this->render('_form', compact('model')); ?>
                </div>
            </div>
        </div>
    </div>
</section>
