<?php

use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\models\service\LanguageService;
use uzdevid\dashboard\models\service\MenuService;
use uzdevid\dashboard\models\YiiMessage;
use yii\bootstrap5\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var uzdevid\dashboard\models\search\YiiMessageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('system.menu', 'Yii Messages');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="card">

        <div class="card-body">
            <div class="text-end py-3">
                <?php echo ModalPage::link(Yii::t('system.content', 'Create Yii Message'), Url::to(['create']), ['class' => 'btn btn-success']) ?>
            </div>

            <?php Pjax::begin(); ?>

            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pager' => [
                    'class' => 'yii\bootstrap5\LinkPager',
                    'maxButtonCount' => 15,
                    'options' => [
                        'tag' => 'nav',
                        'class' => 'd-flex justify-content-center',
                    ]
                ],
                'columns' => [
                    [
                        'attribute' => 'id',
                        'value' => function (YiiMessage $model) {
                            return $model->sourceMessage->message;
                        },
                    ],
                    [
                        'attribute' => 'language',
                        'contentOptions' => ['style' => 'width: 200px'],
                        'filter' => LanguageService::list(),
                        'filterInputOptions' => ['id' => 'filter-language', 'class' => 'form-select'],
                    ],
                    'translation:ntext',
                    [
                        'class' => ActionColumn::class,
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, YiiMessage $model, $key) {
                                return ModalPage::link('<i class="bi bi-eye"></i>', $url, [
                                    'class' => 'btn btn-sm btn-success',
                                    'title' => Yii::t('system.crud', 'View'),
                                ]);
                            },
                            'update' => function ($url, YiiMessage $model, $key) {
                                return ModalPage::link('<i class="bi bi-pencil"></i>', $url, [
                                    'class' => 'btn btn-sm btn-primary',
                                    'title' => Yii::t('system.crud', 'Update'),
                                ]);
                            },
                            'delete' => function ($url, YiiMessage $model, $key) {
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
                        'urlCreator' => function ($action, YiiMessage $model, $key, $index, $column) {
                            return Url::to([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</section>

<script>
    new Choices(document.getElementById('filter-language'), {
        itemSelectText: '',
        classNames: {
            containerOuter: 'choices',
            containerInner: 'choices__inner',
            input: 'choices__input',
            inputCloned: 'choices__input--cloned',
            list: 'choices__list',
            listItems: 'choices__list--multiple',
            listSingle: 'choices__list--single',
            listDropdown: 'choices__list--dropdown',
            item: 'pe-0 choices__item',
            itemSelectable: 'choices__item--selectable',
            itemDisabled: 'choices__item--disabled',
            itemChoice: 'choices__item--choice',
            placeholder: 'choices__placeholder',
            group: 'choices__group',
            groupHeading: 'choices__heading',
            button: 'choices__button',
            activeState: 'is-active',
            focusState: 'is-focused',
            openState: 'is-open',
            disabledState: 'is-disabled',
            highlightedState: 'is-highlighted',
            selectedState: 'is-selected',
            flippedState: 'is-flipped',
            loadingState: 'is-loading',
            noResults: 'has-no-results',
            noChoices: 'has-no-choices'
        },
    });
</script>