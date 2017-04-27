<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\behaviors;

use Yii;
use yii\db\BaseActiveRecord;
use yii\base\Behavior;

class IpAddressBlameableBehavior extends Behavior
{

    public $createdIpAttribute = 'created_ip';

    public $updatedIpAttribute = 'updated_ip';


    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeInsert',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeUpdate',
        ];
    }      
    
    public function onBeforeInsert($event){
        
        $IpAddress = $this->getClientIpAddress();
        $this->owner[$this->createdIpAttribute] = $IpAddress; 
        $this->owner[$this->updatedIpAttribute] = $IpAddress; 
     
    }
  
    public function onBeforeUpdate($event){
        
        $IpAddress = $this->getClientIpAddress(); 
        $this->owner[$this->updatedIpAttribute] = $IpAddress;  
        
    }
    
    protected function getClientIpAddress(){
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR']; 
        } 
        
        return Yii::$app->request->userIP;
    }    
}

