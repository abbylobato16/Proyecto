<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "item_prod".
 *
 * @property int $idItem_Prod
 * @property int $Cantidad
 * @property string $Precio
 * @property string $Importe
 * @property string $Vencimiento
 * @property int $Producto_idProducto
 * @property int $Compras_idCompra
 * @property string $estatusItemProd
 * @property Producto $productoIdProducto
 * @property Compras $comprasIdCompra
 * @property string $estatusNotificacion
 */
class ItemProd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_prod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Cantidad'], 'integer'],
            [['Precio','Importe'],  'string', 'max' => 50],
            [['Vencimiento','Producto_idProducto', 'Compras_idCompra'], 'safe'],
            [['Producto_idProducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['Producto_idProducto' => 'idProducto']],
            [['Compras_idCompra'], 'exist', 'skipOnError' => true, 'targetClass' => Compras::className(), 'targetAttribute' => ['Compras_idCompra' => 'idCompra']],
             [['estatusItemProd','estatusNotificacion'], 'string', 'max' => 45],
             [['Cantidad','Producto_idProducto'], 'required'],
            [['Precio','Importe'], 'required'],
            [['Precio'],'match', "pattern" => "/^[0-9.,]/", "message" => "No permitido"],
            [['Importe'],'match', "pattern" => "/^[0-9.,]/", "message" => "No permitido"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idItem_Prod' => 'ID del Producto: ',
            'Cantidad' => 'Cantidad: ',
            'Precio' => 'Precio: ',
            'Importe' => 'Importe: ',
            'Vencimiento' => 'Fecha de Vencimiento: ',
            'Producto_idProducto' => 'Producto: ',
            'Compras_idCompra' => 'Compras Id Compra',
            'estatusItemProd' => 'Estatus del Producto: ',
            'estatusNotificacion'=>'Estatus Notificación: ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoIdProducto()
    {
        return $this->hasOne(Producto::className(), ['idProducto' => 'Producto_idProducto']);
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComprasIdCompra()
    {
        return $this->hasOne(Compras::className(), ['idCompra' => 'Compras_idCompra']);
    }
}
