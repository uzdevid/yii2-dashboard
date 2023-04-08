<?php

use uzdevid\dashboard\modalpage\ModalPage;
use uzdevid\dashboard\models\ModifyLog;
use yii\bootstrap5\Html;
use Mistralys\Diff\Diff;

/** @var yii\web\View $this */
/** @var ModifyLog $log */
?>

<?php echo Diff::createStyler()->getStyleTag(); ?>

<div class="card">
    <div class="card-body py-3">
        <?php echo $diff->toHtmlTable(); ?>
    </div>
</div>
