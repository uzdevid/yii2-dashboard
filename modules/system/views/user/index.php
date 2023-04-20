<?php

use uzdevid\dashboard\overrides\Url;
use uzdevid\dashboard\models\service\MenuService;
use uzdevid\dashboard\models\service\RoleService;
use uzdevid\dashboard\models\User;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var uzdevid\dashboard\models\search\UserSearch $searchModel */

$this->title = Yii::t('system.menu', 'Users');
$this->params['breadcrumbs'][] = MenuService::breadcrumb('/system/default/index');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(); ?>

    <section class="section">
        <div class="card">
            <div class="card-body py-3">
                <div class="text-end">
                    <?php echo ModalPage::link(Yii::t('system.crud', 'Create User'), Url::to(['create']), ['class' => 'btn btn-success']); ?>
                </div>

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
                        'id',
                        'email:email',
                        'surname',
                        'name',
                        [
                            'attribute' => 'role_id',
                            'filter' => RoleService::list(),
                            'filterInputOptions' => ['id' => 'filter-role_id', 'class' => 'form-select'],
                            'value' => function (User $model) {
                                return @$model->role->translatedName;
                            }
                        ],
                        [
                            'class' => ActionColumn::class,
                            'template' => '{permissions} {view}',
                            'buttons' => [
                                'view' => function ($url, User $model, $key) {
                                    return ModalPage::link('<i class="bi bi-eye"></i>', $url, [
                                        'class' => 'btn btn-sm btn-success',
                                        'title' => Yii::t('system.crud', 'View'),
                                    ]);
                                },
                                'permissions' => function ($url, User $model, $key) {
                                    return ModalPage::link('<i class="bi bi-key"></i>', $url, [
                                        'class' => 'btn btn-sm btn-dark',
                                        'title' => Yii::t('system.content', 'Permissions'),
                                    ]);
                                },
                            ],
                            'contentOptions' => ['class' => 'text-end', 'style' => 'width: 100px'],
                            'urlCreator' => function ($action, User $model, $key, $index, $column) {
                                return Url::to([$action, 'id' => $model->id]);
                            },
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </section>

    <script>
        new Choices(document.getElementById('filter-role_id'), {
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

<?php Pjax::end(); ?>