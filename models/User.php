<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii2x\common\behaviors\IpAddressBlameableBehavior;
use yii2x\user\behaviors\PasswordHashBehavior;
use yii2x\user\behaviors\ConfirmationBehavior;
use yii2x\user\behaviors\AuthBehavior;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property string $email
 * @property string $slug
 * @property string $title
 * @property string $first
 * @property string $last
 * @property string $phone
 * @property datetime $created_at
 * @property int $created_by
 * @property string $created_ip
 * @property datetime $updated_at
 * @property int $updated_by
 * @property string $updated_ip
 * @property datetime $confirm_expired_at
 * @property string $token
 * @property string $confirmed_ip 
 * @property string $confirmed_at
 * @property datetime $rerification_expired_at
 * @property string $rerification_token
 * @property string $recovered_ip
 */

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */    
    public function behaviors()
    {
        return [           

            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('UTC_TIMESTAMP()'),
            ],
	    [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                'value' => function($event){
                    return $this->owner->id;
                }
            ],                  
            [
                'class' => SluggableBehavior::className(),
                'attribute' => ['email'],
                'slugAttribute' => 'slug'
            ],     
	    [
                'class' => IpAddressBlameableBehavior::className(),
                'createdIpAttribute' => 'created_ip',
                'updatedIpAttribute' => 'updated_ip',
            ],                      
            [
                'class' => AuthBehavior::className(),
            ],                        
        ];
    }     
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_\.@]+$/', 'message' => '{attribute} is invalid. Allowed characters [ - . _ @ a-z A-Z 0-9 ]'],
            [['title', 'first', 'last', 'email', 'slug', 'phone', 'password', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['username'], 'string', 'max' => 200],
            [['password_hash', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
    public static function findByEmail($email){
        return self::find()->where([
            'email' => $email,
        ])->one();        
    }
   
    public static function findByUsernameEmail($username, $email){
        return self::find()->where([
            'username' => $username,
            'email' => $email,
        ])->one();        
    }    
    
    public static function findByConfirmToken($token){
        return self::find()->where([
            'token' => $token
        ])->andWhere([
            '>', new Expression('TIMEDIFF(`token_expired_at`,UTC_TIMESTAMP())'), new Expression('TIME("00:00:00")')
        ])->one();        
    }    
    
    public static function findByToken($token){
        return self::find()->where([
            'token' => $token,
        ])->andWhere([
            '>', new Expression('TIMEDIFF(`token_expired_at`,UTC_TIMESTAMP())'), new Expression('TIME("00:00:00")')
        ])->one();
    }
    
    
    /**
    * Validates password
    *
    * @param string $password password to validate
    * @return boolean if password provided is valid for current user
    */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }  
    

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoSignin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoSignin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }


    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId() {
        return $this->id;
    }        
}
