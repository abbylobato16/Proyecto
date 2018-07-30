<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $idProducto
 * @property string $nombresw
 * @property string $descripcion
 * @property string $version
 * @property string $estatusProducto
 * @property string $clave
 *
 * @property ItemProd[] $itemProds
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombresw', 'version', 'estatusProducto','clave'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [['nombresw', 'version','clave'], 'required'],
            [['descripcion'], 'required'],

            /*restricciones de los campos*/
           [['clave'],'match', "pattern" => "/^[A-Za-záéíóúñ0-9\s-]+/i", "message" => "No permitido"],
            [['nombresw'],'match', "pattern" => "/^[A-Za-záéíóúñ0-9\s]+/", "message" => "No permitido"],
           [['descripcion'],'match', "pattern" =>  "/^[A-Za-záéíóúñ0-9\s]+/", "message" => "No permitido"],
           [['version'],'match', "pattern" => "/^[A-Za-záéíóúñ0-9\s-].+/", "message" => "No permitido"],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProducto' => 'ID del Producto: ',
            'nombresw' => 'Producto: ',
            'descripcion' => 'Descripción: ',
            'version' => 'Versión: ',
            'clave' => 'Clave: ',
            'estatusProducto' => 'Estatus del Producto: ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProds()
    {
        return $this->hasMany(ItemProd::className(), ['Producto_idProducto' => 'idProducto']);
    }
}
