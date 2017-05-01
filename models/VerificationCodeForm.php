<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\models;

use Yii;
use yii\base\Model;


class VerificationCodeForm extends Model {
    

    public $username;

    public $password;

    public $confirm_password;
    
    public $verification_code;
    
        
    /**
     * @inheritdoc
     */
    public function rules()
    {       
        return [          

            [['verification_code'], 'required'], 
          
        ];
    }
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verification_code'            => Yii::t('app', 'Verification Code'),
            
        ];
    }    
}
