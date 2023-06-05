<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\access\control\models\ActionUser;
use uzdevid\dashboard\models\service\UserService;
use uzdevid\dashboard\modify\log\models\ModifyLog;
use uzdevid\dashboard\notification\models\Notification;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $email
 * @property string $surname
 * @property string $name
 * @property string|null $image
 * @property int $role_id
 * @property string $language
 * @property string $password
 * @property string|null $last_activity_time
 * @property string $last_update_time
 * @property string $create_time
 *
 * @property User $user
 * @property ActionUser[] $actionUsers
 * @property Contact[] $contacts
 * @property Device[] $devices
 * @property ModifyLog[] $modifyLogs
 * @property Notification[] $notifications
 * @property Role $role
 *
 * @property string $fullname
 * @property string $profileImage
 * @property string $new_password
 */
class User extends ActiveRecord implements IdentityInterface {
    public $new_password = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['user_id', 'role_id'], 'integer'],
            [['email', 'surname', 'name', 'role_id', 'language'], 'required'],
            [['last_activity_time', 'last_update_time', 'create_time'], 'safe'],
            [['email'], 'string', 'max' => 32],
            [['email'], 'email'],
            [['surname', 'name', 'image', 'password'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 2],
            [['email'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
            //
            [['new_password'], 'required', 'on' => 'resetPassword'],
            [['new_password'], 'string', 'min' => 6],
            [['new_password'], 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', 'message' => Yii::t('system.message', 'Password must contain at least one uppercase letter, one lowercase letter and one number.')],
            [['image'], 'image', 'skipOnError' => false, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'user_id' => Yii::t('system.model', 'User ID'),
            'email' => Yii::t('system.model', 'Email'),
            'surname' => Yii::t('system.model', 'Surname'),
            'name' => Yii::t('system.model', 'Name'),
            'image' => Yii::t('system.model', 'Image'),
            'role_id' => Yii::t('system.model', 'Role ID'),
            'language' => Yii::t('system.model', 'Language'),
            'password' => Yii::t('system.model', 'Password'),
            'new_password' => Yii::t('system.model', 'New Password'),
            'last_activity_time' => Yii::t('system.model', 'Last Activity Time'),
            'last_update_time' => Yii::t('system.model', 'Last Update Time'),
            'create_time' => Yii::t('system.model', 'Create Time'),
        ];
    }

    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['timestamp'] = [
            'class' => TimestampBehavior::class,
            'attributes' => [
                BaseActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'last_update_time'],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => ['last_update_time'],
            ]
        ];

        return $behaviors;
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[ActionUsers]].
     *
     * @return ActiveQuery
     */
    public function getActionUsers(): ActiveQuery {
        return $this->hasMany(ActionUser::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return ActiveQuery
     */
    public function getContacts(): ActiveQuery {
        return $this->hasMany(Contact::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Devices]].
     *
     * @return ActiveQuery
     */
    public function getDevices(): ActiveQuery {
        return $this->hasMany(Device::class, ['user_id' => 'id'])->orderBy(['authorization_time' => SORT_DESC]);
    }

    /**
     * Gets query for [[ModifyLogs]].
     *
     * @return ActiveQuery
     */
    public function getModifyLogs(): ActiveQuery {
        return $this->hasMany(ModifyLog::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return ActiveQuery
     */
    public function getNotifications(): ActiveQuery {
        return $this->hasMany(Notification::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return ActiveQuery
     */
    public function getRole(): ActiveQuery {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * @param $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id): User|IdentityInterface|null {
        return static::findOne($id);
    }

    /**
     * @param $token
     * @param $type
     * @return User|IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null): User|IdentityInterface|null {
        return @Device::findOne(['access_token' => $token])->user;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getAuthKey() {
        return null;
    }

    /**
     * @param $authKey
     * @return bool|null
     */
    public function validateAuthKey($authKey): ?bool {
        return Device::find()->where(['access_token' => $authKey, 'user_id' => $this->id])->exists();
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password): bool {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @param $email
     * @return User|null
     */
    public static function findByEmail($email): ?User {
        return static::findOne(['email' => $email]);
    }

    /**
     * @return string
     */
    public function getFullname(): string {
        return $this->surname . ' ' . $this->name;
    }

    public function getProfileImage(): string {
        return $this->image ? Yii::$app->params['profileImageBaseUrl'] . $this->image : Yii::$app->params['profileImageBaseUrl'] . 'default.png';
    }

    /**
     * @param $event
     * @return void
     */
    public static function languageChanged($event): void {
        $user = Yii::$app->user;
        if (!$user->isGuest) {
            $user->identity->language = $event->language;
            $user->identity->save(false);
        }
    }

    public function beforeSave($insert): bool {
        if ($insert) {
            $this->user_id = Yii::$app->user->id;
            $password = rand(100000, 999999);
            UserService::sendLoginDetails($this->email, $password);
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
        }

        return parent::beforeSave($insert);
    }

    public function beforeDelete(): bool {
        $this->unlinkAll('devices', true);

        if (class_exists(Notification::class)) {
            $this->unlinkAll('notifications', true);
        }

        if (class_exists(Contact::class)) {
            $this->unlinkAll('contacts', true);
        }

        if (class_exists(ActionUser::class)) {
            $this->unlinkAll('actionUsers', true);
        }

        if (class_exists(ModifyLog::class)) {
            $this->unlinkAll('modifyLogs', true);
        }

        return parent::beforeDelete();
    }

    public function resetPassword() {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->new_password);
    }
}
