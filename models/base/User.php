<?php

namespace uzdevid\dashboard\models\base;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $email
 * @property string $surname
 * @property string $name
 * @property string|null $image
 * @property string $language
 * @property string $password
 * @property int|null $last_activity_time
 * @property int|null $last_update_time
 * @property int $create_time
 * @property int $role_id
 *
 * @property Contact[] $contacts
 * @property Device[] $devices
 * @property Role $role
 * @property User $user
 * @property User[] $users
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'last_activity_time', 'last_update_time', 'create_time', 'role_id'], 'default', 'value' => null],
            [['user_id', 'last_activity_time', 'last_update_time', 'create_time', 'role_id'], 'integer'],
            [['email', 'surname', 'name', 'language', 'password', 'create_time'], 'required'],
            [['email', 'surname', 'name', 'image', 'password'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 5],
            [['email'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'user_id' => Yii::t('system.model', 'User ID'),
            'email' => Yii::t('system.model', 'Email'),
            'surname' => Yii::t('system.model', 'Surname'),
            'name' => Yii::t('system.model', 'Name'),
            'image' => Yii::t('system.model', 'Image'),
            'language' => Yii::t('system.model', 'Language'),
            'password' => Yii::t('system.model', 'Password'),
            'last_activity_time' => Yii::t('system.model', 'Last Activity Time'),
            'last_update_time' => Yii::t('system.model', 'Last Update Time'),
            'create_time' => Yii::t('system.model', 'Create Time'),
            'role_id' => Yii::t('system.model', 'Role ID'),
        ];
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Devices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['user_id' => 'id']);
    }
}
