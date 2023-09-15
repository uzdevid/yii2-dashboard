<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\generators\crud\Generator $generator */

$modelClass = StringHelper::basename($generator->modelClass);

echo "<?php\n";
?>

use <?= $generator->modelClass ?>;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\base\helpers\Url;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/** @var yii\web\View $this */
<?= !empty($generator->searchModelClass) ? "/** @var " . ltrim($generator->searchModelClass, '\\') . " \$searchModel */\n" : '' ?>
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $generator->enablePjax ? "<?php Pjax::begin(); ?>\n" : '' ?>
<section class="section">
    <div class="card">
        <div class="card-body py-3">
            <div class="text-end mb-3">
                <?= "<?php echo " ?>ModalPage::link(<?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, Url::to(['create']), ['class' => 'btn btn-success']) ?>
            </div>
            <div class="table-responsive">
<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?php echo " ?>GridView::widget([
        'dataProvider' => $dataProvider,
        <?php if (!empty($generator->searchModelClass)): ?>
        'filterModel' => $searchModel,
        'pager' => [
            'class' => 'yii\bootstrap5\LinkPager',
            'maxButtonCount' => 15,
            'options' => [
                'tag' => 'nav',
                'class' => 'd-flex justify-content-center',
            ]
        ],
        <?php else: ?>
        'pager' => [
            'class' => 'yii\bootstrap5\LinkPager',
            'maxButtonCount' => 15,
            'options' => [
                'tag' => 'nav',
                'class' => 'd-flex justify-content-center',
            ]
        ],
        <?php endif;?>
        'columns' => [
<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            '" . $name . "',\n";
        } else {
            echo "            //'" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        } else {
            echo "            //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>
            [
                'class' => ActionColumn::class,
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => static function ($url, <?= $modelClass ?> $model, $key) {
                        return Html::a('<i class="bi bi-eye"></i>', $url, [
                            'class' => 'btn btn-sm btn-success',
                            'title' => Yii::t('system.crud', 'View'),
                        ]);
                    },
                    'update' => static function ($url, <?= $modelClass ?> $model, $key) {
                        return Html::a('<i class="bi bi-pencil"></i>', $url, [
                            'class' => 'btn btn-sm btn-primary',
                            'title' => Yii::t('system.crud', 'Update'),
                        ]);
                    },
                    'delete' => static function ($url, <?= $modelClass ?> $model, $key) {
                        return Html::a('<i class="bi bi-trash"></i>', $url, [
                            'class' => 'btn btn-sm btn-danger',
                            'title' => Yii::t('system.crud', 'Delete'),
                            'data' => [
                                'confirm' => Yii::t('system.message', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
                'headerOptions' => ['class' => 'text-end', 'style' => 'min-width: 130px'],
                'urlCreator' => static function ($action, <?= $modelClass ?> $model, $key, $index, $column) {
                    return Url::to([$action, <?= $generator->generateUrlParams() ?>]);
                }
            ],
        ],
    ]); ?>
<?php else: ?>
    <?= "<?php echo " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $generator->getNameAttribute() ?>), ['view', <?= $generator->generateUrlParams() ?>]);
        },
    ]) ?>
<?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>