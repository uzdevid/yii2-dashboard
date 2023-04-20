<?php

use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\service\MenuService;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var uzdevid\dashboard\models\search\MenuSearch $searchModel */

$this->title = Yii::t('system.menu', 'Menu');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title"><?php echo Yii::t('system.content', 'Menu'); ?></h2>

                        <?php echo ModalPage::link(Yii::t('system.content', 'Create Menu'), Url::to(['create']), ['class' => 'btn btn-success']); ?>
                    </div>

                    <?php Pjax::begin(); ?>

                    <?php echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            'id',
                            [
                                'attribute' => 'title',
                                'value' => function (Menu $model) {
                                    return $model->translatedTitle;
                                }
                            ],
                            [
                                'attribute' => 'role_id',
                                'value' => function (Menu $model) {
                                    return @$model->role->translatedName;
                                }
                            ],
                            [
                                'class' => ActionColumn::class,
                                'template' => '{view} {update} {delete}',
                                'buttons' => [
                                    'view' => function ($url, Menu $model, $key) {
                                        return ModalPage::link('<i class="bi bi-eye"></i>', $url, [
                                            'class' => 'btn btn-sm btn-success',
                                            'title' => Yii::t('system.crud', 'View'),
                                        ]);
                                    },
                                    'update' => function ($url, Menu $model, $key) {
                                        return ModalPage::link('<i class="bi bi-pencil"></i>', $url, [
                                            'class' => 'btn btn-sm btn-primary',
                                            'title' => Yii::t('system.crud', 'Update'),
                                        ]);
                                    },
                                    'delete' => function ($url, Menu $model, $key) {
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
                                'contentOptions' => ['class' => 'text-end', 'style' => 'width: 130px'],
                                'urlCreator' => function ($action, Menu $model, $key, $index, $column) {
                                    return Url::to([$action, 'id' => $model->id]);
                                },
                            ],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><?php echo Yii::t('system.content', 'Menu structure'); ?></h2>
                    <ul id="menu-tree"></ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const delay = () => {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve();
            }, 500);
        });
    };

    $(document).ready(function () {
        $.get(BASEURL + '/' + LANGUAGE + '/system/api/menu/index', function (data) {
            const treeId = "#menu-tree";
            const MenuSortable = new TreeSortable({
                treeSelector: treeId,
                removeBranch: false,
            });

            const $leftTree = $(treeId);
            const $content = data.body.menu.map(MenuSortable.createBranch);
            $leftTree.html($content);
            MenuSortable.run();

            MenuSortable.onSortCompleted(async function (event, ui) {
                await delay();

                let menus = [];
                ui.item.parent().children().each(function (index) {
                    menus.push({
                        id: $(this).data('id'),
                        parent_id: $(this).data('parent'),
                        level: $(this).data('level'),
                        order: index + 1
                    });
                });

                $.post(BASEURL + '/' + LANGUAGE + '/system/api/menu/sort-completed', JSON.stringify({menus: menus}))
                    .done((data) => {
                        if (data.toaster.script) {
                            eval(data.toaster.script);
                        }
                    })
                    .fail(function (error) {
                        toaster.error(error.responseJSON.body.message, error.responseJSON.body.name);
                    });
            });
        });
    });
</script>
