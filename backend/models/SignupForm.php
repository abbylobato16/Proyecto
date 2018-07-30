<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use backend\models\AuthAssignment;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $firts_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $permissions;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['firts_name', 'required'],
            ['last_name', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],



            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }



public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'username' => 'Usuario: ',
           // 'auth_key' => 'Auth Key',
            //'password_hash' => 'Password Hash',
            'password' => 'Contraseña: ',
            'email' => 'Correo Electrónico: ',
            //'status' => 'Status',
           // 'created_at' => 'Created At',
            //'updated_at' => 'Updated At',
            'firts_name' => 'Nombre(s): ',
            'last_name' => 'Apellido(s): ',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->firts_name = $this->firts_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;


        $permissionList = $_POST['SignupForm']['permissions'];
        foreach ($permissionList as $value) {
        
        $newPermission = new AuthAssignment;
        $newPermission->user_id;
        $newPermission->item_name = $value;
        $newPermission->save();
        }

       


    }
}
