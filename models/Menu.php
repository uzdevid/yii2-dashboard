<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\components\BaseModel;
use Throwable;
use Yii;
use yii\db\ActiveQuery;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $role_id
 * @property int|null $parent_id
 * @property string $icon
 * @property string $title
 * @property string $link
 * @property int $order
 *
 * @property Menu[] $menus
 * @property Menu $parent
 * @property Role $role
 *
 * @property-read string $translatedTitle
 * @property-read int $level
 */
class Menu extends BaseModel {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['role_id', 'parent_id', 'order'], 'integer'],
            [['icon', 'title', 'link', 'order'], 'required'],
            [['icon', 'title', 'link'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'role_id' => Yii::t('system.model', 'Role ID'),
            'parent_id' => Yii::t('system.model', 'Parent ID'),
            'icon' => Yii::t('system.model', 'Icon'),
            'title' => Yii::t('system.model', 'Title'),
            'link' => Yii::t('system.model', 'Link'),
            'order' => Yii::t('system.model', 'Order'),
        ];
    }

    /**
     * Gets query for [[Menus]].
     *
     * @return ActiveQuery
     */
    public function getMenus(): ActiveQuery {
        return $this->hasMany(Menu::class, ['parent_id' => 'id'])
            ->andWhere(['role_id' => @Yii::$app->user->identity->role->id])
            ->orWhere(['role_id' => null])
            ->orderBy(['order' => SORT_ASC]);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return ActiveQuery
     */
    public function getParent(): ActiveQuery {
        return $this->hasOne(Menu::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return ActiveQuery
     */
    public function getRole(): ActiveQuery {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }


    public function getTranslatedTitle(): string {
        return Yii::t('system.menu', $this->title);
    }

    /**
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function beforeDelete(): bool {
        foreach ($this->menus as $menu) {
            $menu->delete();
        }
        return parent::beforeDelete();
    }

    /**
     * @return int
     */
    public function getLevel(): int {
        $level = 0;
        $parent = $this->parent;
        while ($parent) {
            $level++;
            $parent = $parent->parent;
        }
        return $level;
    }
}
