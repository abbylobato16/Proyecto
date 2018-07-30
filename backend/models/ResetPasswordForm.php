<?php
namespace backend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
        public $password;
        public $email;
        public $password_repeat;
        public $verification_code;
        public $recover;

    /**
     * @var \common\models\User
     */
    //private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
   /* public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        parent::__construct($config);
    }
*/
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['email', 'password', 'password_repeat', 'verification_code', 'recover'], 'required', 'message' => 'Campo requerido'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
            ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
        ];
    }
public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            //'username' => 'Usuario: ',
           // 'auth_key' => 'Auth Key',
            //'password_hash' => 'Password Hash',
            'password' => 'Contraseña: ',
            'email' => 'Email: ',
            //'status' => 'Status',
           // 'created_at' => 'Created At',
            //'updated_at' => 'Updated At',
            'password_repeat'=>'Repita la Contraseña: ',
            'verification_code' => 'Código de Verificación: '
        ];
    }
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
   /* public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }*/
}
