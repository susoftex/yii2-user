<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170425_191046_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(20),
            'username' => $this->string(200)->defaultValue(NULL)->unique(),
            'password_hash' => $this->string(255)->defaultValue(NULL),
            'auth_key' => $this->string(255)->defaultValue(NULL)->unique(),
            'email' => $this->string(200)->defaultValue(NULL)->unique(),
            'slug' => $this->string(200)->defaultValue(NULL)->unique(),
            'title' => $this->string(45)->defaultValue(NULL),
            'first' => $this->string(45)->defaultValue(NULL),
            'last' => $this->string(45)->defaultValue(NULL),
            'phone' => $this->string(45)->defaultValue(NULL),
            'confirm_expired_at' => $this->datetime()->defaultValue(NULL),
            'confirm_token' => $this->string(64)->defaultValue(NULL),            
            'created_at' => $this->datetime()->defaultValue(NULL),
            'created_by' => $this->integer(20)->defaultValue(NULL),
            'created_ip' => $this->string(64)->defaultValue(NULL),
            'updated_at' => $this->datetime()->defaultValue(NULL),
            'updated_by' => $this->integer(20)->defaultValue(NULL),
            'updated_ip' => $this->string(64)->defaultValue(NULL),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
