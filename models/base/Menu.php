<?php

namespace uzdevid\dashboard\models\base;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $icon
 * @property string $title
 * @property string $link
 * @property int $order
 *
 * @property Menu[] $menus
 * @property Menu $parent
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'order'], 'default', 'value' => null],
            [['parent_id', 'order'], 'integer'],
            [['icon', 'title', 'link', 'order'], 'required'],
            [['icon', 'title', 'link'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('system.model', 'ID'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Menu::class, ['id' => 'parent_id']);
    }
}
