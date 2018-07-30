<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $firts_name
 * @property string $last_name
 */
class ChangePass extends \yii\db\ActiveRecord
{



        public $password;
        public $oldpassword;
        public $password_repeat;
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
            [[ 'password','password_repeat','oldpassword'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['firts_name', 'last_name'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],

            ['password', 'compare', 'compareAttribute' => 'oldpassword', 'operator'=>'!==','message' => 'No puede elegir la misma contraseña.'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contraseñas no coinciden.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario: ',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Correo Electrónico: ',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'firts_name' => 'Nombre(s): ',
            'last_name' => 'Apellido(s): ',
            'password'=>'Contraseña: ',
            'oldpassword'=>'Antigua Contraseña: ',
            'password_repeat'=>'Repita la Contraseña: '
        ];
    }

        public function validatePassword($oldpassword)
    {
        return Yii::$app->security->validatePassword($oldpassword, $this->password_hash);
    }
}
