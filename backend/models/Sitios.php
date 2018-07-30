<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sitios".
 *
 * @property int $idSitio
 * @property string $nombreSitio
 * @property string $url
 * @property string $username
 * @property string $passwords
 * @property string $email
 */
class Sitios extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sitios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreSitio', 'username', 'passwords', 'email'], 'string', 'max' => 45],
            [['url'], 'string', 'max' => 200],
            [['nombreSitio', 'username', 'passwords', 'email'], 'required'],
            [['url'], 'required'],
              ['email', 'email'],
            [['nombreSitio'],'match', "pattern" => "/^[A-Za-záéíóúñ0-9\s-]+/i", "message" => "No permitido"],
             [['url'],'match', "pattern" => "/^[A-Za-záéíóúñ0-9\s-]+/i", "message" => "No permitido"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idSitio' => 'ID del Sitio: ',
            'nombreSitio' => 'Sitio Web: ',
            'url' => 'Url: ',
            'username' => 'Usuario: ',
            'passwords' => 'Contraseña: ',
            'email' => 'Correo Electrónico: ',
        ];
    }
}
