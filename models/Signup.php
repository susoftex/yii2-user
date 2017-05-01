<?php

namespace yii2x\user\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii2x\user\behaviors\IpAddressBlameableBehavior;
use yii2x\user\behaviors\SignupBehavior;

/**
 * This is the model class for table "signup".
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property string $created_at
 * @property string $created_ip
 * @property string $expired_at
 */
class Signup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'signup';
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
                'updatedAtAttribute' => 'created_at',
                'value' => new Expression('UTC_TIMESTAMP()'),
            ],   
	    [
                'class' => IpAddressBlameableBehavior::className(),
                'createdIpAttribute' => 'created_ip',
                'updatedIpAttribute' => 'created_ip',
            ],                      
            [
                'class' => SignupBehavior::className(),
            ],                        
        ];
    }         
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['created_at', 'expired_at'], 'safe'],
            [['email'], 'string', 'max' => 200],
            [['token', 'created_ip'], 'string', 'max' => 64],
            [['email'], 'findAndDelete'],
            [['email'], 'unique'],
            [['token'], 'unique'],
            [
                'email',
                'unique',
                'targetClass' => 'yii2x\user\models\User',
                'message' => Yii::t('app', 'Email already taken')
            ],            
        ];
    }    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'token' => 'Token',
            'created_at' => 'Created At',
            'created_ip' => 'Created Ip',
            'expired_at' => 'Expired At',
        ];
    }
    
    
    public function findAndDelete($attribute, $params)
    {
        $m = self::find()->where([$attribute => $this->$attribute])->one();
        if($m){
            $m->delete();
        }
        return true;
    }    
    
    public static function findByToken($token){
        return self::find()->where([
            'token' => $token
        ])->andWhere([
            '>', new Expression('TIMEDIFF(`expired_at`,UTC_TIMESTAMP())'), new Expression('TIME("00:00:00")')
        ])->one();       
    }
    
}
