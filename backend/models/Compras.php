<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "compras".
 *
 * @property int $idCompra
 * @property string $NoFactura
 * @property string $Fecha
 * @property string $PrecioTotal
 * @property string $Titular
 * @property string $Mantenimiento
 * @property string $image_src_filename
 * @property string $image_web_filename
 * @property string $estatusCompra
 * @property int $Proveedores_idproveedor
 * @property Proveedores $proveedoresIdproveedor
 * @property ItemProd[] $itemProds
 */
class Compras extends \yii\db\ActiveRecord
{

    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NoFactura'], 'string', 'max' => 45],
            [['Fecha','Proveedores_idproveedor'], 'safe'],
           // [['PrecioTotal'], 'number'],
            [['Mantenimiento'], 'string'],
            [['Titular','PrecioTotal'], 'string', 'max' => 50],
            [['image_src_filename', 'image_web_filename'], 'string', 'max' => 500],
            [['estatusCompra'], 'string', 'max' => 45],
             [['file'], 'safe'],
            [['file'], 'file', 'extensions'=>'jpg,pdf,png,jpeg'],
            [['file'], 'file', 'maxSize'=>'100000'],

            [['Proveedores_idproveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::className(), 'targetAttribute' => ['Proveedores_idproveedor' => 'idproveedor']],

            [['NoFactura','Proveedores_idproveedor'], 'required'],
            [['Fecha'], 'required'],
            [['PrecioTotal'], 'required'],
            [['Mantenimiento'], 'required'],
            [['Titular'], 'required'],

            /*Restricciones*/
            [['Titular'],'match', "pattern" => "/^[A-Za-záéíóúñ.\s]/", "message" => "No permitido"],
            [['PrecioTotal'],'match', "pattern" => "/^[0-9.,]/", "message" => "No permitido"],
            [['NoFactura'],'match', "pattern" => "/^[0-9A-Za-záéíóúñ\s.,]/", "message" => "No permitido"],

            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCompra' => 'ID de Compra: ',
            'NoFactura' => 'No. Factura: ',
            'Fecha' => 'Fecha: ',
            'PrecioTotal' => 'Precio Total: ',
            'Titular' => 'Titular: ',
            'Mantenimiento' => 'Mantenimiento: ',
            'file'=>'Archivo: ',
      'image_src_filename' => Yii::t('app', 'Archivo: '),
      'image_web_filename' => Yii::t('app', 'Pathname'),  
            'estatusCompra' => 'Estatus de la Compra: ',
            'Proveedores_idproveedor' => 'Proveedor: ',
        ];
    }

 
 /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedoresIdproveedor()
    {
        return $this->hasOne(Proveedores::className(), ['idproveedor' => 'Proveedores_idproveedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    public function getItemProds()
    {
        return $this->hasMany(ItemProd::className(), ['Compras_idCompra' => 'idCompra']);
    }
}
